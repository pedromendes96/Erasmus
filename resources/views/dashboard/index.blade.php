@extends('layouts.master')
@section('title','Erasmus - Messages')

@section('content')
    <div class="entire-screen center"
         style="padding: 100px 0px;background-image: url(/img/pexels-photo-288477.jpeg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
        <div class="fifteen-screen">

        </div>
        <div class="seventy-screen"
             style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
            <div class="entire-screen center" style="border-bottom:1px solid black;padding: 0px 0px !important;">
                <h1>Dashboard</h1>
            </div>
            <div class="entire-screen" style="margin-bottom: 35px;">
                <h1>{{ucfirst($user->role)}}: {{$user->name}}</h1>
                @if($user->role == "student" && $active)
                    <button class="dashboardButtons newProcessButton">Create New Process</button>
                @endif
                @if($process)
                    <button class="dashboardButtons" onclick="window.location='{{ url("dashboard/process") }}'">My
                        Processes
                    </button>
                    <button class="dashboardButtons" onclick="window.location='{{ url("dashboard/messages/1") }}'">My
                        Messages
                    </button>
                @endif
                <button class="dashboardButtons" onclick="window.location='{{ url("dashboard/settings") }}'">My Settings
                </button>
                <button class="backButton" hidden>BACK</button>
            </div>
            <!-- CREATE NEW PROCESS-->
            @if($user->role == "student" && $active)
                <div class="quart-screen"></div>
                <div id="newProcess" class="half-screen center" hidden>
                    <h3>New Process</h3>
                    <form role="form" method="POST" action="/dashboard/newProcess">
                        {{ csrf_field() }}
                        <label for="country">Select Country destination:</label>
                        <select name="country" onchange="showCitiesRadio(this.value)" required>//Correct the
                            onChange!!!!!!!!!
                            <option value="">---</option>
                            @foreach($countries as $country)
                                @if($user->country->id != $country->id)
                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <div id="cities"></div>
                        <div id="universities" style="margin-bottom: 20px;"></div>
                        <label for="semester">Select your desired Erasmus semester:</label>
                        <select name="semester">
                            <option value="">---</option>
                            <option value="1º">1º Semester(Winter)</option>
                            <option value="2º">2º Semester(Summer)</option>
                        </select>
                        <br>
                        <br>
                        <br>
                        <button type="submit">Register</button>
                    </form>
                </div>
            @endif
        </div>
        <div class="fifteen-screen">

        </div>
    </div>
@endsection