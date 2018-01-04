@extends('layouts.master')
@section('title','Erasmus - Log In')


@section ('content')
<div class="entire-screen center" style="background-image: url(/img/pexels-photo-288477.jpeg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="fifteen-screen">

    </div>
    <div class="seventy-screen"
         style="padding: 0px 0px !important;border: 1px solid black;margin: 60px 0px;background-color: #eeeeee">
        <div class="entire-screen" style="padding: 0px 0px !important;">
            <h1>Message</h1>
        </div>
        <div>
            @if($id != $sender->id)
                <h2>From: {{$sender->name}}</h2>
            @else
                <h2>From: You</h2>
            @endif
            <input type="hidden" name="sender" value="{{$sender->id}}">
        </div>
        <div class="entire-screen">
            <div class="center"><h2>Subject:</h2></div>
            <h3>{{$message->subject}}</h3>
        </div>
        <div class="entire-screen" style="padding: 20px 20px;">
            <div class="center"><h2>Content:</h2></div>
            <h4>{{$message->content}}</h4>
        </div>
        @if($id != $sender->id)
            <div class="entire-screen">
                <div class="quart-screen"></div>
                <div class="half-screen"><a href="/dashboard/replymessage/{{$msg}}">Reply Message</a></div>
            </div>
        @endif
    </div>
    <div class="fifteen-screen">

    </div>
</div>

@endsection