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
        function ChangeCountry(valor){
            if(valor === "name"){
                $("#ChangeCountrySection").html("<label>New Name</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
            }else{
                $("#ChangeCountrySection").html("<label>New Description</label><br><input type=\"text\" name=\"descritpion\"><button>Change Description</button>");
            }
        }
        function ChangeCity(valor){
            if(valor === "name"){
                $("#countries").addClass("hide");
                $("#ChangeCitySection").html("<label>New Name</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
            }else if(valor === "description"){
                $("#countries").addClass("hide");
                $("#ChangeCitySection").html("<label>New Description</label><br><input type=\"text\" name=\"descritpion\"><button>Change Description</button>");
            }else{
                $("#ChangeCitySection").html("");
                $("#countries").removeClass("hide");
            }
        }

        function ChangeAddress(valor){
            if(valor === "name"){
                $("#cities").addClass("hide");
                $("#ChangeAddressSection").html("<label>New Name</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
            }else{
                $("#ChangeAddressSection").html("");
                $("#cities").removeClass("hide");
            }
        }

        function ChangeUniversity(valor){
            if(valor === "name"){
                $("#adresses").addClass("hide");
                $("#ChangeUniversitySection").html("<label>New Name</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
            }else if(valor ==="description"){
                $("#adresses").addClass("hide");
                $("#ChangeUniversitySection").html("<label>New Description</label><br><input type=\"text\" name=\"description\"><button>Change Description</button>");
            }else if(valor==="email") {
                $("#adresses").addClass("hide");
                $("#ChangeUniversitySection").html("<label>New Email</label><br><input type=\"email\" name=\"email\"><button>Change Email</button>");
            }else if(valor==="image"){
                $("#adresses").addClass("hide");
                $("#ChangeUniversitySection").html("<label>New Image</label><br><input type=\"file\" name=\"image\"><br><button>Change Image</button>");
            }else{
                $("#ChangeUniversitySection").html("");
                $("#adresses").removeClass("hide");
            }
        }

        function ChangeNew(valor){
            if(valor === "title"){
                $("#news").html("<label>New Title</label><br><input type=\"text\" name=\"name\"><button>Change Name</button>");
            }else if(valor ==="description"){
                $("#news").html("<label>New Description</label><br><input type=\"text\" name=\"description\"><button>Change Description</button>");
            }else if(valor==="content") {
                $("#news").html("<label>New Content</label><br><input type=\"text\" name=\"content\"><button>Change Content</button>");
            }else{
                $("#news").html("<label>New Image</label><br><input type=\"file\" name=\"image\"><br><button>Change Image</button>");
            }
        }
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
    <div class="seventy-screen" style="padding: 0 0 !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
        <div class="entire-screen" style="padding: 0 0 !important;  ">
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
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="add">
                    <input name="type" type="hidden" value="country">
                    <label>Country Name:</label>
                    <input type="text"><br>
                    <label>Description:</label>
                    <br>
                    <input type="text">
                    <button>Create Country</button>
                </form>

            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add City</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="add">
                    <input name="type" type="hidden" value="city">
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

            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add Address</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="add">
                    <input name="type" type="hidden" value="address">
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

            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add University</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="add">
                    <input name="type" type="hidden" value="university">
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



            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add New</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="add">
                    <input name="type" type="hidden" value="new">
                    <label>New title:</label><br>
                    <input type="text"><br>
                    <label>Description:</label><br>
                    <input type="text"><br>
                    <label>Content:</label><br>
                    <input type="text"><br>
                    <label>new image</label><br>
                    <input type="file"><br><br>
                    <button>Create New</button>
                </form>
            </div>
        </div>

        <div id="changeSection" class="entire-screen hide">
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Change Country</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="change">
                    <input name="type" type="hidden" value="country">
                    <select name="country">
                        <option style="display:none;" selected>Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">
                                {{$country->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeCountry(this.value)">
                        <option style="display:none;" selected>Select Column</option>
                        <option value="name">Name</option>
                        <option value="description">Description</option>
                    </select>
                    <div id="ChangeCountrySection">

                    </div>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Change City</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="change">
                    <input name="type" type="hidden" value="city">
                    <select name="country">
                        <option style="display:none;" selected>Select City</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">
                                {{$city->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeCity(this.value)">
                        <option style="display:none;" selected>Select Column</option>
                        <option value="name">Name</option>
                        <option value="description">Description</option>
                        <option value="country">Country</option>
                    </select>
                    <div>
                        <div id="ChangeCitySection">

                        </div>
                        <div class="hide" id="countries">
                            <select name="country">
                                <option style="display:none;" selected>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">
                                        {{$country->name}}
                                    </option>
                                @endforeach
                            </select>
                            <button>Change Country</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Change Address</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="change">
                    <input name="type" type="hidden" value="address">
                    <select name="address">
                        <option style="display:none;" selected>Select Address</option>
                        @foreach($addresses as $address)
                            <option value="{{$address->id}}">
                                {{$address->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeAddress(this.value)">
                        <option style="display:none;" selected>Select Column</option>
                        <option value="name">Name</option>
                        <option value="country">City</option>
                    </select>
                    <div>
                        <div id="ChangeAddressSection">

                        </div>
                        <div class="hide" id="cities">
                            <select name="city">
                                <option style="display:none;" selected>Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">
                                        {{$city->name}}
                                    </option>
                                @endforeach
                            </select>
                            <button>Change Address</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Change University</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="change">
                    <input name="type" type="hidden" value="university">
                    <select name="universities">
                        <option style="display:none;" selected>Select University</option>
                        @foreach($universities as $university)
                            <option value="{{$university->id}}">
                                {{$university->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeUniversity(this.value)">
                        <option style="display:none;" selected>Select Column</option>
                        <option value="name">Name</option>
                        <option value="description">Description</option>
                        <option value="email">Email</option>
                        <option value="image">Image</option>
                        <option value="address">Address</option>
                    </select>
                    <div>
                        <div id="ChangeUniversitySection">

                        </div>
                        <div class="hide" id="adresses">
                            <select name="address">
                                <option style="display:none;" selected>Select Address</option>
                                @foreach($addresses as $address)
                                    <option value="{{$address->id}}">
                                        {{$address->name}}
                                    </option>
                                @endforeach
                            </select>
                            <button>Change University</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Change New</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="change">
                    <input name="type" type="hidden" value="new">
                    <select name="news">
                        <option style="display:none;" selected>Select University</option>
                        @foreach($news as $new)
                            <option value="{{$new->id}}">
                                {{$new->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeNew(this.value)">
                        <option style="display:none;" selected>Select Column</option>
                        <option value="title">Title</option>
                        <option value="description">Description</option>
                        <option value="content">Content</option>
                        <option value="image">Image</option>
                    </select>
                    <div>
                        <div id="news">

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="removeSection" class="entire-screen hide">
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Delete country</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="delete">
                    <input name="type" type="hidden" value="country">
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
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="delete">
                    <input name="type" type="hidden" value="city">
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
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="delete">
                    <input name="type" type="hidden" value="address">
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
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="delete">
                    <input name="type" type="hidden" value="university">
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

            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Delete New</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="delete">
                    <input name="type" type="hidden" value="new">
                    <label>Select New</label>
                    <select name="new">
                        @foreach($news as $new)
                            <option value="{{$new->id}}">
                                {{$new->title}}
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