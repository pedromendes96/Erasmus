@extends('layouts.master')
@section('title','Erasmus - Log In')


@section ('content')
<div class="entire-screen center" style="background-image: url(/img/pexels-photo-288477.jpeg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="fifteen-screen">

    </div>
    <div class="seventy-screen" style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
        <div class="entire-screen" style="padding: 0px 0px !important;">
            <div class="quart-screen dashboard-option">
                <h1>Opcao</h1>
            </div>
            <div class="quart-screen dashboard-option">
                <h1>Opcao</h1>
            </div>
            <div class="quart-screen dashboard-option">
                <h1>Opcao</h1>
            </div>
            <div class="quart-screen dashboard-option">
                <h1>Opcao</h1>
            </div>
        </div>
        <div>
            <form method="post" action="/dashboard/Newmessages/">
                {{csrf_field()}}
                <div class="entire-screen">
                    @if($action == "reply")
                        <label>To:</label>
                        <select name="sender">
                            <option value="{{$receiver->id}}">{{$receiver->name}}</option>
                        </select>
                    @else
                        <label>To:</label>
                        <select name="sender">
                            <option style="display:none;" selected>Select Destinatary:</option>
                            @if($role="student")
                                <option value="{{$manager->id}}">
                                    {{$manager->name}}
                                </option>
                                <option value="{{$director->id}}">
                                    {{$director->name}}
                                </option>
                            @elseif($role="manager")
                                @foreach($candidates as $candidate)
                                    <option value="{{$candidate->id}}">
                                        {{$candidate->name}}
                                    </option>
                                @endforeach
                                @foreach($directors as $director)
                                        <option value="{{$director->id}}">
                                            {{$director->name}}
                                        </option>
                                    @endforeach
                            @else
                                @foreach($candidates as $candidate)
                                    <option value="{{$candidate->id}}">
                                        {{$candidate->name}}
                                    </option>
                                @endforeach
                                @foreach($managers as $manager)
                                        <option value="{{$manager->id}}">
                                            {{$manager->name}}
                                        </option>
                                    @endforeach
                            @endif
                        </select>
                    @endif
                </div>
                <div class="entire-screen">
                    @if($action == "reply")
                        <label>Subject: </label>{{$subject}}<input name="subject" type="hidden" value="{{$subject}}">
                    @else
                        <label>Subject:</label><input type="text" name="subject">
                    @endif
                </div>
                <div class="entire-screen">
                    <label>Content:</label><textarea name="answer" rows="12" cols="150"></textarea>
                </div>
                <div class="entire-screen">
                    <div class="quart-screen"></div>
                    <div class="half-screen">
                        <button>Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="fifteen-screen">

    </div>
</div>

@endsection