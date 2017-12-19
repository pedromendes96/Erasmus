<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Erasmus</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Abhaya Libre' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        $(document).ready(function() {
            $('#add').click(function() {
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
            });
        });
    </script>
</head>
<body>
<div class="entire-screen navbar">
    <div class="third-screen center">
        <a href="/"><img src="/img/erasmus.png" width="50%"></a>
    </div>
    <div class="two-third-screen right">
        <ul>
            <li>
                Home
            </li>
            <li>
                More Info
            </li>
            <li>
                Log Out
            </li>
        </ul>
    </div>
</div>
<div class="entire-screen center" style="background-image: url(/img/pexels-photo-288477.jpeg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="fifteen-screen">

    </div>
    <div class="seventy-screen" style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
        <div class="entire-screen" style="padding: 0px 0px !important;  ">
            <div id="add" class="third-screen" style="border: 1px solid black;">
                <h1>Add</h1>
            </div>
            <div id="change" class="third-screen" style="border-top: 1px solid black;border-bottom: 1px solid black;">
                <h1>Change</h1>
            </div>
            <div id="remove" class="third-screen" style="border: 1px solid black;">
                <h1>Remove</h1>
            </div>
        </div>
        <div id="addSection" class="entire-screen">
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add Country</h1>
                <form method="post">
                    <label>Country Name:</label>
                    <input type="text"><br>
                    <label>Description:</label>
                    <br>
                    <input type="text">
                    <button>Create Country</button>
                </form>
                <hr>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;"   >
                <h1>Add City</h1>
                <form method="post">
                    <label>City Name:</label><br>
                    <input type="text"><br>
                    <label>Description:</label><br>
                    <input type="text"><br>
                    <label>Select the country</label>
                    <select name="country">
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    <button>Create City</button>
                </form>
                <hr>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add Address</h1>
                <form method="post">
                    <label>Address Name:</label><br>
                    <input type="text"><br>
                    <label>Description:</label><br>
                    <input type="text"><br>
                    <label>Select the city</label><br>
                    <select name="country">
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <button>Create Address</button>
                </form>
                <hr>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add University</h1>
                <form method="post">
                    <label>University Name:</label><br>
                    <input type="text"><br>
                    <label>Description:</label><br>
                    <input type="text"><br>
                    <label>University email:</label><br>
                    <input type="email"><br>
                    <label>University image</label><br>
                    <input type="file"><br><br>
                    <label>Select the address</label>
                    <select name="country">
                        @foreach($addresses as $address)
                            <option value="{{$address->id}}">{{$address->name}}</option>
                        @endforeach
                    </select>
                    <button>Create University</button>
                </form>
            </div>
        </div>

        <div id="changeSection" class="entire-screen hide">
            <div class="entire-screen" style="padding: 20px 20px !important;">
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
            </div>
        </div>

        <div id="removeSection" class="entire-screen hide">
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Delete country</h1>
                <form method="post">
                    <label>Select Country</label><br>
                    <select name="country">
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">
                            {{$country->name}}
                        </option>
                        @endforeach
                    </select>
                    <button>Delete</button>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Delete city</h1>
                <form method="post">
                    <label>Select City</label><br>
                    <select name="city">
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">
                            {{$city->name}}
                        </option>
                        @endforeach
                    </select>
                    <button>Delete</button>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Delete Address</h1>
                <form method="post">
                    <label>Select Address</label><br>
                    <select name="address">
                        @foreach($addresses as $address)
                            <option value="{{$address->id}}">
                                {{$address->name}}
                            </option>
                        @endforeach
                    </select>
                    <button>Delete</button>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Delete University</h1>
                <form method="post">
                    <label>Select University</label>
                    <select name="university">
                        @foreach($universities as $university)
                            <option value="{{$university->id}}">
                                {{$university->name}}
                            </option>
                        @endforeach
                    </select>
                    <button>Delete</button>
                </form>
            </div>
        </div>
    </div>
    <div class="fifteen-screen">

    </div>
</div>

<div class="entire-screen blue-theme">
    <div class="third-screen">
        <h5></h5>
    </div>
    <div class="third-screen center">
        <ul>
            <li>
                <a href="#"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
    <div class="third-screen center">
        <h4>Copyright ERASMUS+</h4>
    </div>
</div>
</body>
</html>