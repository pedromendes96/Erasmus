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
            {{session('userid')}}
            <h1>Profile: {{$user->name}}</h1>
        </div>
        <div class="entire-screen center">
            <div class="third-screen field-size">
                Name: {{$user->name}}
            </div>
        </div>
        <div class="entire-screen center">
            <div class="third-screen field-size">
                Email: {{$user->email}}
            </div>
        </div>
        <div class="entire-screen center">
            <div class="third-screen field-size">
                Phone: {{$user->phone}}
            </div>
        </div>
        <div class="entire-screen center">
            <div class="third-screen field-size">
                University: {{$user->university}}
            </div>
        </div>
        <div class="entire-screen center">
            <div class="third-screen field-size">
                Address: {{$user->address}}
            </div>
        </div>
        <div class="entire-screen center">
            <div class="third-screen field-size">
                City: {{$user->city}}
            </div>
        </div>
        <div class="entire-screen center">
            <div class="third-screen field-size">
                Country: {{$user->country}}
            </div>
        </div>
        @if ($user->role == "student" or $user->role == "director")
        <div class="entire-screen center">
            <div class="third-screen field-size">
                Program: {{$user->program}}
            </div>
        </div>
        @endif
        <form method="POST" action="/dashboard/userprofile">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button>Edit Profile</button>
        </form>
    </div>
</div>
@section('footer')