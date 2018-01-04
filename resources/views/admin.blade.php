@extends('layouts.master')
@section('title','Erasmus - Admnistrator')

@section('content')
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
                    <input type="text" name="name" required><br>
                    <label>Description:</label>
                    <br>
                    <input type="text" name="description" required>
                    <button>Create Country</button>
                </form>

            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add City</h1>
                <form method="post" action="/admin/">{{csrf_field()}}
                    <input name="operation" type="hidden" value="add">
                    <input name="type" type="hidden" value="city">
                    <label>City Name:</label><br>
                    <input type="text" name="name" required><br>
                    <label>Description:</label><br>
                    <input type="text" name="description" required><br>
                    <label>Select the country</label>
                    <select name="country" required>
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
                    <input type="text" name="name" required><br>
                    <label>Select the city</label><br>
                    <select name="city" required>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <button>Create Address</button>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add University</h1>
                <form method="post" action="/admin/" enctype="multipart/form-data">{{csrf_field()}}
                    <input name="operation" type="hidden" value="add">
                    <input name="type" type="hidden" value="university">
                    <label>University Name:</label><br>
                    <input type="text" name="name" required><br>
                    <label>Description:</label><br>
                    <input type="text" name="description" required><br>
                    <label>University email:</label><br>
                    <input type="email" name="email" required><br>
                    <label>Latitude:</label>
                    <br>
                    <input type="text" name="x">
                    <br>
                    <label>Longitude:</label>
                    <br>
                    <input type="text" name="y"><br>
                    <label>University image</label><br>
                    <input type="file" name="image" required><br><br>
                    <label>Select the address</label>
                    <select name="address" required>
                        @foreach($addresses as $address)
                            <option value="{{$address->id}}">{{$address->name}}</option>
                        @endforeach
                    </select>
                    <button>Create University</button>
                </form>
            </div>
            <div class="entire-screen" style="padding: 20px 20px !important;">
                <h1>Add New</h1>
                <form method="post" action="/admin/" enctype="multipart/form-data">{{csrf_field()}}
                    <input name="operation" type="hidden" value="add">
                    <input name="type" type="hidden" value="new">
                    <label>New title:</label><br>
                    <input type="text" name="title" required><br>
                    <label>Description:</label><br>
                    <input type="text" name="description" required><br>
                    <label>Content:</label><br>
                    <input type="text" name="container" required><br>
                    <label>new image</label><br>
                    <input type="file" name="image" required><br><br>
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
                    <select name="country" required>
                        <option style="display:none;" selected>Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">
                                {{$country->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeCountry(this.value)" required>
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
                    <select name="country" required>
                        <option style="display:none;" selected>Select City</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">
                                {{$city->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeCity(this.value)" required>
                        <option style="display:none;" selected>Select Column</option>
                        <option value="name">Name</option>
                        <option value="description">Description</option>
                        <option value="country">Country</option>
                    </select>
                    <div>
                        <div id="ChangeCitySection">

                        </div>
                        <div class="hide" id="countries">
                            <select name="country" required>
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
                    <select name="address" required>
                        <option style="display:none;" selected>Select Address</option>
                        @foreach($addresses as $address)
                            <option value="{{$address->id}}">
                                {{$address->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeAddress(this.value)" required>
                        <option style="display:none;" selected>Select Column</option>
                        <option value="name">Name</option>
                        <option value="city">City</option>
                    </select>
                    <div>
                        <div id="ChangeAddressSection">

                        </div>
                        <div class="hide" id="cities">
                            <select name="city" required>
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
                <form method="post" action="/admin/" enctype="multipart/form-data">{{csrf_field()}}
                    <input name="operation" type="hidden" value="change">
                    <input name="type" type="hidden" value="university">
                    <select name="universities" required>
                        <option style="display:none;" selected>Select University</option>
                        @foreach($universities as $university)
                            <option value="{{$university->id}}">
                                {{$university->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeUniversity(this.value)" required>
                        <option style="display:none;" selected>Select Column</option>
                        <option value="name">Name</option>
                        <option value="description">Description</option>
                        <option value="email">Email</option>
                        <option value="image">Image</option>
                        <option value="address">Address</option>
                        <option value="x">Latitude</option>
                        <option value="y">Longitude</option>
                    </select>
                    <div>
                        <div id="ChangeUniversitySection">

                        </div>
                        <div class="hide" id="adresses">
                            <select name="address" required>
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
                <form method="post" action="/admin/" enctype="multipart/form-data">{{csrf_field()}}
                    <input name="operation" type="hidden" value="change">
                    <input name="type" type="hidden" value="new">
                    <select name="news" required>
                        <option style="display:none;" selected>Select New</option>
                        @foreach($news as $new)
                            <option value="{{$new->id}}">
                                {{$new->id}}-{{$new->title}}
                            </option>
                        @endforeach
                    </select>
                    <select name="column" onchange="ChangeNew(this.value)" required>
                        <option style="display:none;" selected>Select Column</option>
                        <option value="title">Title</option>
                        <option value="description">Description</option>
                        <option value="container">Content</option>
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
                    <select name="country" required>
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
                    <select name="city" required>
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
                    <select name="address" required>
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
                    <select name="university" required>
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
                    <select name="new" required>
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

@endsection