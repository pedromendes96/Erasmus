@extends('layouts.master')


{{--/*--}}
{{--Change the BR into padding on the media queries on CSS.--}}

{{--This index is the dashboard of the software that will show up after you login.--}}
{{--The view will change depending by the roll(student,manager or director) of the user.--}}
{{--*/--}}
@section ('content')
    <div class="entire-screen"
         style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
        <br>
        <br>
        <br>
        <br>
        <!-- MAIN BUTTONS-->
        <div class="entire-screen">
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
            <div id="newProcess" class="half-screen" hidden>
                <h3>New Process</h3>
                <form role="form" method="POST" action="/dashboard/newProcess">
                    {{ csrf_field() }}
                    <label for="country">Select Country destination:</label>
                    <select name="country" onchange="showCities(this.value)" required>//Correct the onChange!!!!!!!!!
                        <option value="">---</option>
                        @foreach($countries as $country)
                            <option value="{{$country->name}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <div id="cities"></div>
                    <div id="universities"></div>

                    <br>
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

@endsection