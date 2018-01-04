var app = require('express')();
var express = require('express');
var bodyParser = require('body-parser');
app.use(express.static(__dirname));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
    extended: true
}));
var mysql = require('mysql');
var http = require('http').Server(app);
var io = require('socket.io')(http);
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "Erasmus"
});


app.set('view engine', 'ejs');

con.connect(function (err) {
    if (err) throw err;
});

var rooms = [];

app.post('/', function (req, res) {
    var data = {};
    var origination = req.body.origination;
    var destination = req.body.destination
    data.img = req.body.image;
    data.personName = req.body.personName;
    data.chatName = origination + "-" + destination;
    res.render('index', data);
});

app.get('/chatPeople', function (req, res) {
    res.send(rooms);
});

io.on('connection', function (socket) {

    socket.on("room", function (data) {
        var sql = "SELECT * FROM chatmessages WHERE room='" + data.chatName + "'";
        con.query(sql, function (err, result) {
            if (err) throw err;
            result.forEach(function (element) {
                total = {};
                total.msg = element.content;
                total.name = element.name;
                total.img = element.img;
                socket.emit('update', total);
            });
        });
        var existence;
        var index;
        if (rooms.length > 0) {
            rooms.forEach(function (element, i) {
                if (element.name === data.name) {
                    existence == true;
                    index = i;
                }
            });
        }
        if (existence !== undefined) {
            var person = {};
            person.id = socket.id;
            person.name = data.personName;
            person.img = data.img;

            rooms[index].people.push(JSON.stringify(person));
        } else {
            var newRoom = {};
            newRoom.name = data.chatName;
            newRoom.people = [];

            var person = {};
            person.id = socket.id;
            person.name = data.personName;
            person.img = data.img;
            newRoom.people.push(JSON.stringify(person));
            rooms.push(newRoom);
        }

        socket.room = data.chatName;
        socket.person = data.personName;
        socket.img = data.img;

        socket.join(socket.room);
        console.log("Juntou se ao room " + socket.room);
        console.log(rooms);
    });

    socket.on("send", function (msg) {
        total = {};
        total.msg = msg.data;
        total.name = socket.person;
        total.img = socket.img;
        var now = new Date();
        var sql = "INSERT INTO chatmessages (content, room, img, name, created_at) VALUES ('" + total.msg + "', '" + socket.room + "','" + socket.img + "','" + socket.person + "','" + now.getTime() + "')";
        con.query(sql, function (err, result) {
            if (err) throw err;
            console.log("1 record inserted");
        });
        con.commit();
        io.sockets.in(socket.room).emit('update', total);
    });

    socket.on('disconnect', function () {
        rooms.forEach(function (element, index) {
            if (element.name === socket.room) {
                element.people.forEach(function (person, i) {
                    person = JSON.parse(person);
                    if (person.id === socket.id) {
                        element.people.splice(i, 1);
                        if (element.people.length === 0) {
                            console.log("NAO HA NINGUEM");
                            rooms.splice(index, 1);
                        }
                    }
                });
            }
        });
    });
});

http.listen(8080, function () {
    console.log('Listening in port 8080');
});

