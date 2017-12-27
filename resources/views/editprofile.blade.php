<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Erasmus teste</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Abhaya Libre' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<html>


@extends('layouts.app')

@section('navbar')
    @section('action','Log Out')
<div class="entire-screen" style="margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="two-third-screen">
        <div class="entire-screen center">
            <br>
            <h1>Edit Profile: {{$user->name}}</h1>
        </div>
        <form method="POST" action="/dashboard/userprofile/edit">
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Name
                </div>
                <div class="two-third-screen">
                    <input type="text" name="name" placeholder="{{$user->name}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Email
                </div>
                <div class="two-third-screen">
                    <input type="text" name="email" placeholder="{{$user->email}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Phone
                </div>
                <div class="two-third-screen">
                    <input type="text" name="phone" placeholder="{{$user->phone}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    New Password
                </div>
                <div class="two-third-screen">
                    <input type="password" name="password">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Confirm Password
                </div>
                <div class="two-third-screen">
                    <input type="password" name="confirmpassword">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Country
                </div>
                <div class="two-third-screen">
                    <select name="country">
                        <option selected value="{{$user->country->id}}">{{$user->country->name}}</option>
                        @foreach($countries as $ctry)
                            @if ($user->country->id == $ctry->id){}
                        @else
                            <option value ="{{$ctry->id}}">{{$ctry->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    City
                </div>
                <div class="two-third-screen">
                    <input type="text" name="city" placeholder="{{$user->city->name}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Address
                </div>
                <div class="two-third-screen">
                    <input type="text" name="address" placeholder="{{$user->address->name}}">
                </div>
            </div>
            @if (session('cityb4addr'))
            <div class="entire-screen center">
                <div class="third-screen field-size">

                </div>
                <div class="two-third-screen">
                    Please insert an address if u want to edit the city!
                </div>
            </div>
            @endif
            @if (session('phoneExists'))
                <div class="entire-screen center">
                    <div class="third-screen field-size">

                    </div>
                    <div class="two-third-screen">
                        The phone number you inserted is already in use!
                    </div>
                </div>
            @endif
            @if (session('emailExists'))
                <div class="entire-screen center">
                    <div class="third-screen field-size">

                    </div>
                    <div class="two-third-screen">
                        The email address you inserted is already in use!
                    </div>
                </div>
            @endif
            @if (session('pwNotMatch'))
                <div class="entire-screen center">
                    <div class="third-screen field-size">

                    </div>
                    <div class="two-third-screen">
                        The passwords you inserted doest not match!
                    </div>
                </div>
            @endif

            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="userid" value="{{$user->id}}">
            <input type="hidden" name="role" value="{{$user->role}}">
            <button type="submit">Edit Information</button>
        </form>

    </div>
</div>

@section('footer')

