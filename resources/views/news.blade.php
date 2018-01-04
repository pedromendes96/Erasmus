@extends('layouts.master')
@section('title','Erasmus - Log In')


@section ('content')
<div class="entire-screen center" style="background-image: url(/img/background.jpeg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="quart-screen">

    </div>
    <div class="half-screen" style="border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
        <div class="entire-screen">
            <h1>{{$info->title}}</h1>
        </div>
        <div class="entire-screen">
            <img width="80%" src="{{asset('storage/'.$info->img)}}">
        </div>
        <div class="entire-screen">
            <div class="quart-screen">

            </div>
            <div class="half-screen">
                {{$info->content}}
            </div>
            <div class="quart-screen">

            </div>
        </div>
    </div>
    <div class="quart-screen">

    </div>
</div>

@endsection