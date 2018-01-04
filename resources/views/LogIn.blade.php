@extends('layouts.master')
@section('title','Erasmus - Log In')


@section ('content')

    <div class="entire-screen center"
         style="background-image: url(/img/backgroundLogin.jpg);background-repeat: no-repeat;background-size:cover;margin-top: 103px;padding-right: 0px !important;padding-bottom: 0px !important;">
        <div class="fifteen-screen">

        </div>
        <div class="seventy-screen"
             style="padding: 0px 0px !important;border: 1px solid black;margin: 30px 0px;background-color: #eeeeee">
            <div class="entire-screen" style="margin: 50px 0px;padding: 0px 0px !important;">
                <h1>Login</h1>
                <form style="padding: 25px 25px;" method="post" action="/LogIn">
                    {{csrf_field()}}
                    <div class="entire-screen">
                        <label>Email:</label><input type="email" placeholder="Your email" name="email">
                    </div>
                    <div class="entire-screen">
                        <label>Password:</label><input type="password" placeholder="Your password" name="password">
                    </div>
                    <div class="quart-screen">

                    </div>
                    <div class="half-screen center">
                        <button type="submit" class="main-button">Log In</button>
                        <br>
                        <span>Don't have an account? <a href="/register">register here</a></span>
                    </div>
                </form>
            </div>
            @if (session('incorrect')==1 or session('noexistence')==1)
                <div class="entire-screen center" style="margin-bottom: 25px;">
                    <div class="quart-screen"></div>
                    <div class="half-screen" style="background-color: red;padding: 15px 15px;">
                        @if(session('incorrect')==1)
                            <span>Os valores inseridos nao estao corretos.</span><br>
                            <span><a href="/resetpassword">Forgot your password?</a></span>
                        @else
                            <span>Nao existe um utilizador com esse email.</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="fifteen-screen">

        </div>
    </div>

@endsection
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--<meta charset="UTF-8">--}}
{{--<title>Erasmus</title>--}}
{{--<link rel="stylesheet" href="/css/main.css">--}}
{{--<link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">--}}
{{--<link href='https://fonts.googleapis.com/css?family=Abhaya Libre' rel='stylesheet'>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
{{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="entire-screen navbar">--}}
{{--<div class="third-screen center">--}}
{{--<a href="/"><img src="/img/erasmus.png" width="50%"></a>--}}
{{--</div>--}}
{{--<div class="two-third-screen right">--}}
{{--<ul>--}}
{{--<li>--}}
{{--Home--}}
{{--</li>--}}
{{--<li>--}}
{{--More Info--}}
{{--</li>--}}
{{--<li>--}}
{{--Log In--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="entire-screen center" style="height: 80vh;background-image: url(/img/backgroundLogin.jpg);background-repeat: no-repeat;background-size:cover;margin-top: 103px;padding-right: 0px !important;padding-bottom: 0px !important;">--}}
{{--<div class="fifteen-screen">--}}

{{--</div>--}}
{{--<div class="seventy-screen" style="padding: 0px 0px !important;border: 1px solid black;margin: 30px 0px;background-color: #eeeeee">--}}
{{--<div class="entire-screen" style="margin: 50px 0px;padding: 0px 0px !important;">--}}
{{--<form style="--}}
{{--padding: 25px 25px;" method="post" action="/LogIn">--}}
{{--{{csrf_field()}}--}}
{{--<div class="entire-screen">--}}
{{--<label>Email:</label><input type="email" placeholder="Your email" name="email">--}}
{{--</div>--}}
{{--<div class="entire-screen">--}}
{{--<label>Password:</label><input type="password" placeholder="Your password" name="password">--}}
{{--</div>--}}
{{--<div class="quart-screen">--}}

{{--</div>--}}
{{--<div class="half-screen center">--}}
{{--<button type="submit" class="main-button">Log In</button>--}}
{{--<br>--}}
{{--<span>Don't have an account? <a href="/register">register here</a></span>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--@if (session('incorrect')==1 or session('noexistence')==1)--}}
{{--<div class="entire-screen center" style="margin-bottom: 25px;">--}}
{{--<div class="quart-screen"></div>--}}
{{--<div class="half-screen" style="background-color: red;padding: 15px 15px;">--}}
{{--@if(session('incorrect')==1)--}}
{{--<span>Os valores inseridos nao estao corretos.</span><br>--}}
{{--<span><a href="/resetpassword">Forgot your password?</a></span>--}}
{{--@else--}}
{{--<span>Nao existe um utilizador com esse email.</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--@endif--}}
{{--</div>--}}
{{--<div class="fifteen-screen">--}}

{{--</div>--}}
{{--</div>--}}

{{--<div class="entire-screen blue-theme">--}}
{{--<div class="third-screen">--}}
{{--<h5></h5>--}}
{{--</div>--}}
{{--<div class="third-screen center">--}}
{{--<ul>--}}
{{--<li>--}}
{{--<a href="#"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--<div class="third-screen center">--}}
{{--<h4>Copyright ERASMUS+</h4>--}}
{{--</div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}