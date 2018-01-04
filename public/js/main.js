function showCitiesRadio(value) {
    $.get("http://localhost:8000/citiesR?country=" + value, function (data) {
        $("#cities").html(data);
    });
}

function showCities(value) {
    $.get("http://localhost:8000/cities?country=" + value, function (data) {
        $("#cities").html(data);
    });
}

var n = 0;

function ChangeNews() {
    if ($("#third").length) {
        if (n === 0) {
            $('#first').fadeOut("slow");
            $('#second').fadeIn("slow");
            n++;
        } else if (n === 1) {
            $('#second').fadeOut("slow");
            $('#third').fadeIn("slow");
            n++;
        } else {
            $('#third').fadeOut("slow");
            $('#first').fadeIn("slow");
            n = 0;
        }
    } else if ($("#second").length) {
        if (n === 0) {
            $('#first').fadeOut("slow");
            $('#second').fadeIn("slow");
            n++;
        } else {
            $('#second').fadeOut("slow");
            $('#first').fadeIn("slow");
            n = 0;
        }
    }
}

setInterval(ChangeNews, 7000);

function showUniversitiesRadio(value) {
    $.get("http://localhost:8000/radiouniversities?city=" + value, function (data) {
        $("#universities").html(data);
    });
}

function showUniversities(value) {
    $.get("http://localhost:8000/universities?city=" + value, function (data) {
        $("#universities").html(data);
    });
}

function showUniversitiesC(value) {

    $.get("http://localhost:8000/universitiesC?country=" + value, function (data) {
        $("#universities").html(data);
    });
}

function showPrograms(value) {
    $.get("http://localhost:8000/programs?university=" + value, function (data) {
        if ($('#role').val() == "student" || $('#role').val() == "director") {
            $("#programs").html(data);
        }
    });
}

function ChangeProcesses(value) {
    var x = value.split('-');
    var index = x[0]
    var role = x[1]
    var id = x[2]
    $.get("http://localhost:8000/indexprocess?id=" + id + "&role=" + role + "&index=" + index, function (data) {
        $("#processes").html(data);
    });
}

function showMap() {
    var x = parseFloat($('#x').val());
    var y = parseFloat($('#y').val());
    var myCenter = new google.maps.LatLng(x, y);
    var mapCanvas = document.getElementById("map");
    var mapOptions = {center: myCenter, zoom: 5};
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({position: myCenter});
    marker.setMap(map);
}

$(document).ready(function () {
    $('#role').change(function () {
        selection = $(this).val();
        switch (selection) {
            case 'student':
                $('#directorstudent').show();
                showUniversitiesC($('#country').val());
                showPrograms($('#university').val());

                break;
            case 'manager':
                $('#directorstudent').hide();
                showUniversitiesC($('#country').val());
                showPrograms($('#university').val());
                break;
            case 'director':
                $('#directorstudent').show();
                showUniversitiesC($('#country').val());
                showPrograms($('#university').val());
            default:
                $('#directorstudent').show();
                showUniversitiesC($('#country').val());
                showPrograms($('#university').val());
                break;
        }
    });

    function ChangeCountry(valor) {
        if (valor === "name") {
            $("#ChangeCountrySection").html("<label>New Name</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
        } else {
            $("#ChangeCountrySection").html("<label>New Description</label><br><input type=\"text\" name=\"descritpion\"><button>Change Description</button>");
        }
    }

    function ChangeCity(valor) {
        if (valor === "name") {
            $("#countries").addClass("hide");
            $("#ChangeCitySection").html("<label>New Name</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
        } else if (valor === "description") {
            $("#countries").addClass("hide");
            $("#ChangeCitySection").html("<label>New Description</label><br><input type=\"text\" name=\"descritpion\"><button>Change Description</button>");
        } else {
            $("#ChangeCitySection").html("");
            $("#countries").removeClass("hide");
        }
    }

    function ChangeAddress(valor) {
        if (valor === "name") {
            $("#cities").addClass("hide");
            $("#ChangeAddressSection").html("<label>New Name</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
        } else {
            $("#ChangeAddressSection").html("");
            $("#cities").removeClass("hide");
        }
    }

    function ChangeUniversity(valor) {
        if (valor === "name") {
            $("#adresses").addClass("hide");
            $("#ChangeUniversitySection").html("<label>New Name</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
        } else if (valor === "description") {
            $("#adresses").addClass("hide");
            $("#ChangeUniversitySection").html("<label>New Description</label><br><input type=\"text\" name=\"description\"><button>Change Description</button>");
        } else if (valor === "email") {
            $("#adresses").addClass("hide");
            $("#ChangeUniversitySection").html("<label>New Email</label><br><input type=\"email\" name=\"email\"><button>Change Email</button>");
        } else if (valor === "image") {
            $("#adresses").addClass("hide");
            $("#ChangeUniversitySection").html("<label>New Image</label><br><input type=\"file\" name=\"image\"><br><button>Change Image</button>");
        } else if (valor === "address") {
            $("#ChangeUniversitySection").html("");
            $("#adresses").removeClass("hide");
        } else if (valor === "x") {
            $("#adresses").addClass("hide");
            $("#ChangeUniversitySection").html("<label>New Latitude</label><br><input type=\"text\" name=\"x\"><br><button>Change Latitude</button>");
        } else {
            $("#adresses").addClass("hide");
            $("#ChangeUniversitySection").html("<label>New Longitude</label><br><input type=\"text\" name=\"y\"><br><button>Change Longitude</button>");
        }
    }

    function ChangeNew(valor) {
        if (valor === "title") {
            $("#news").html("<label>New Title</label><br><input type=\"text\" name=\"name\" required><button>Change Name</button>");
        } else if (valor === "description") {
            $("#news").html("<label>New Description</label><br><input type=\"text\" name=\"description\" required><button>Change Description</button>");
        } else if (valor === "content") {
            $("#news").html("<label>New Content</label><br><input type=\"text\" name=\"content\" required><button>Change Content</button>");
        } else {
            $("#news").html("<label>New Image</label><br><input type=\"file\" name=\"image\" required><br><button>Change Image</button>");
        }
    }

    $('#add').click(function () {
        $('#changeSection').addClass('hide');
        $('#removeSection').addClass('hide');
        $('#addSection').removeClass('hide');
    });
    $('#change').click(function () {
        $('#removeSection').addClass('hide');
        $('#addSection').addClass('hide');
        $('#changeSection').removeClass('hide');
    });
    $('#remove').click(function () {
        $('#changeSection').addClass('hide');
        $('#addSection').addClass('hide');
        $('#removeSection').removeClass('hide');
    });

    $(".newProcessButton").click(function () {
        $(".dashboardButtons").slideUp("slow");
        $(".backButton").slideDown("slow");
        $("#newProcess").slideDown("slow");
    });
    $(".backButton").click(function () {
        $(".backButton").slideUp("slow");
        $("#newProcess").slideUp("slow");
        $(".dashboardButtons").slideDown("slow");
    });


    $("#editDestinationButton").click(function () {
        $("#editDestinationOptions").slideToggle("slow");
    });
    $("#uploadButton").click(function () {
        $("#uploadOptions").slideToggle("slow");
    });
    $("#downloadButton").click(function () {
        $("#downloadOptions").slideToggle("slow");
    });
    $("#approveResultButton").click(function () {
        $("#approveResultOptions").slideToggle("slow");
    });
    $("#approveResultNo").click(function () {
        $("#approveResultOptions").slideToggle("slow");
    });
    $("#approveResultYes").click(function () {
        $("#approveResultOptions").slideToggle("slow");
        $("#approvedResult").slideToggle("slow");
    });


    $('.fileEvent').hover(
        function () {
            $(this).css({"background-color": "pink"});
        },
        function () {
            $(this).css({"background-color": "white"});
        }
    );


});