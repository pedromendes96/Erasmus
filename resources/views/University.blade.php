@extends('layouts.master')
@section('title','Erasmus - Log In')


@section ('content')

<div class="entire-screen center" style="background-image: url(/img/information.jpg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="fifteen-screen">

    </div>
    <div class="seventy-screen" style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
        <div class="entire-screen">
            <h1>{{$university->name}}</h1>
        </div>
        <div class="entire-screen">
            <div class="quart-screen"></div>
            <div class="half-screen"><img width="100%" src="{{asset('storage/'.$university->img)}}"></div>
        </div>
        <div class="entire-screen">
            <h1>Description</h1>
        </div>
        <div class="entire-screen" style="word-wrap: break-word;padding: 20px 20px;">
            <p>{{$university->description}}</p>
            <p><b>Contact:</b></p>
            <p>{{$university->email}}</p>
        </div>


        <div class="entire-screen" id="map" style="width: 100%;height: 300px;z-index: 1211321321;">
            <input type="hidden" id="x" value="{{$university->x}}">
            <input type="hidden" id="y" value="{{$university->y}}">
            <button style="margin-top: 150px;" onclick="showMap()">SHOW LOCATION</button>
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPMZeM6yVcAmBKtLy0IyQBOG6nMFX1NjM&callback=myMap"></script>
    </div>
    <div class="fifteen-screen">

    </div>
</div>

@endsection