@extends('layouts.master')
@section('title','Erasmus - Settings')


@section ('content')

    <div class="entire-screen center"
         style="background-image: url(/img/backgroundLogin.jpg);background-repeat: no-repeat;background-size:cover;margin-top: 103px;padding-right: 0px !important;padding-bottom: 0px !important;">
        <div class="fifteen-screen">

        </div>
        <div class="seventy-screen"
             style="padding: 0px 0px !important;border: 1px solid black;margin: 30px 0px;background-color: #eeeeee">
            <div class="entire-screen" style="margin: 50px 0px;padding: 0px 0px !important;">

                <div class="entire-screen"
                     style="margin-top: 0px;padding-right: 0px !important;padding-bottom: 0px !important;">
                    <div class="entire-screen center">
                        <br>
                        <h1>My profile: {{$user->name}}</h1>
                    </div>
                    <div class="entire-screen center">
                        <img width="20%" src="{{asset('storage/'.$user->img)}}">
                    </div>
                    <div class="entire-screen center">
                        <div class="third-screen field-size">
                            Role:
                        </div>
                        <div class="third-screen field-size left">
                            {{$user->role}}
                        </div>
                    </div>
                    <div class="entire-screen center">
                        <div class="third-screen field-size">
                            Name:
                        </div>
                        <div class="third-screen field-size left">
                            {{$user->name}}
                        </div>
                    </div>
                    <div class="entire-screen center">
                        <div class="third-screen field-size">
                            Email:
                        </div>
                        <div class="third-screen field-size left">
                            {{$user->email}}
                        </div>
                    </div>
                    <div class="entire-screen center">
                        <div class="third-screen field-size">
                            Phone:
                        </div>
                        <div class="third-screen field-size left">
                            {{$user->phone}}
                        </div>
                    </div>
                    <div class="entire-screen center">
                        <div class="third-screen field-size">
                            Address:
                        </div>
                        <div class="third-screen field-size left">
                            {{$user->address->name}}
                        </div>
                    </div>
                    <div class="entire-screen center">
                        <div class="third-screen field-size">
                            City:
                        </div>
                        <div class="third-screen field-size left">
                            {{$user->city->name}}
                        </div>
                    </div>
                    <div class="entire-screen center">
                        <div class="third-screen field-size">
                            Country:
                        </div>
                        <div class="third-screen field-size left">
                            {{$user->country->name}}
                        </div>
                    </div>
                    <div class="entire-screen center">
                        <div class="third-screen field-size">
                            University:
                        </div>
                        <div class="third-screen field-size left">
                            {{$user->university->name}}
                        </div>
                    </div>
                    @if ($user->role == "student" or $user->role == "director")
                        <div class="entire-screen center">
                            <div class="third-screen field-size">
                                Program:
                            </div>
                            <div class="third-screen field-size left">
                                {{$user->program->name}}
                            </div>
                        </div>
                    @endif
                    <form method="POST" action="/dashboard/settings">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="entire-screen center">
                            <button class="main-button" type="submit" style="text-align:center">Edit Profile</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection