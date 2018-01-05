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
    <script src="/js/main.js"></script>
</head>
<body>
    <div style="background: url(/img/fundo.jpg);background-repeat: no-repeat;height: 620px;" class="entire-screen flex-container">
        <div class="entire-screen center" style="padding: 25px 0px;margin-bottom: 100px;">
            <img src="/img/erasmus.png">
        </div>

        <div class="entire-screen">
            <div class="half-screen center">
                @if (session('userID'))
                    @if(session('userID')=="admin")
                        <a href="/admin">
                            <button class="main-button">Admin</button>
                        </a>
                    @else
                        <a href="/dashboard">
                            <button class="main-button">Dashboard</button>
                        </a>
                    @endif
                @else
                    <a href="/LogIn">
                        <button class="main-button">Log in</button>
                    </a>
                @endif
            </div>
            <div class="half-screen center">
                @if(!session('userID'))
                    <a href="/register">
                        <button class="main-button">Create a Account</button>
                    </a>
                @else
                    <a href="/logout">
                        <button class="main-button">Log Out</button>
                    </a>
                @endif
            </div>
            <div class="entire-screen center">
                <a href="/information">
                    <button class="main-button">More information</button>
                </a>
            </div>
        </div>
    </div>
    <div class="entire-screen">
        <div class="entire-screen center">
            <h1>News</h1>
        </div>
        <div id="first">
            @for($i=0;$i<2;$i++)
                <div class="half-screen">
                    <div class="entire-screen center">
                        <h1><a href="http://localhost:8000/news/{{$selectedNews[$i]->id}}">{{$selectedNews[$i]->title}}</a></h1>
                    </div>
                    <div class="entire-screen center">
                        <a href="http://localhost:8000/news/{{$selectedNews[$i]->id}}"><img width="60%" src="{{asset('storage/'.$selectedNews[$i]->img)}}"></a>
                    </div>
                    <div class="entire-screen">
                        <p>{{$selectedNews[$i]->description}}</p>
                    </div>
                </div>
            @endfor
        </div>
        @if($number >= 4)
            <div class="hide" id="second">
                @for($i=2;$i<4;$i++)
                    <div class="half-screen">
                        <div class="entire-screen center">
                            <h1><a href="http://localhost:8000/news/{{$selectedNews[$i]->id}}">{{$selectedNews[$i]->title}}</a></h1>
                        </div>
                        <div class="entire-screen center">
                            <a href="http://localhost:8000/news/{{$selectedNews[$i]->id}}"><img width="60%" src="{{asset('storage/'.$selectedNews[$i]->img)}}"></a>
                        </div>
                        <div class="entire-screen">
                            <p>{{$selectedNews[$i]->description}}</p>
                        </div>
                    </div>
                @endfor
            </div>
        @endif
        @if($number == 6)
            <div class="hide" id="third">
                @for($i=4;$i<6;$i++)
                    <div class="half-screen">
                        <div class="entire-screen center">
                            <h1><a href="http://localhost:8000/news/{{$selectedNews[$i]->id}}">{{$selectedNews[$i]->title}}</a></h1>
                        </div>
                        <div class="entire-screen center">
                            <a href="http://localhost:8000/news/{{$selectedNews[$i]->id}}"><img width="60%" src="{{asset('storage/'.$selectedNews[$i]->img)}}"></a>
                        </div>
                        <div class="entire-screen">
                            <p>{{$selectedNews[$i]->description}}</p>
                        </div>
                    </div>
                @endfor
            </div>
        @endif
    </div>
@extends('layouts.footer')