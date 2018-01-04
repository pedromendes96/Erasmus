@extends('layouts.master')
@section('title','Erasmus - Messages')

@section('content')
    <div class="entire-screen center"
         style="background-image: url(/img/pexels-photo-288477.jpeg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
        <div class="fifteen-screen">

        </div>
        <div class="seventy-screen"
             style="padding: 0 0 !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
            <div class="entire-screen center" style="padding: 0px 0px !important;">
                <h1>Dashboard</h1>
            </div>
            <div class="entire-screen center">
                <h1>Select Process: {{ucfirst($user->role)}} - {{$user->name}}</h1>
            </div>
            <div class="entire-screen center">
                <div class="quart-screen"></div>
                <div id="processes" class="half-screen">
                    @for($i = 0; $i < $processes->count(); $i++)
                        <div>
                            <h3 style="float: left">Process
                                {{$processes[$i]->updated_at->day."/".$processes[$i]->updated_at->month."/".$processes[$i]->updated_at->year}}
                                :
                                <strong @if($processes[$i]->active==1)style="color: green"
                                        @else style="color: indianred"@endif >@if($processes[$i]->active==1)Active @else
                                        Inactive @endif</strong>
                            </h3>

                        </div>
                        <br>
                        <br>
                        <div style="border: 2px solid #272981;text-align: center">
                            <br>
                            <br>
                            <a href="/dashboard/process/{{encrypt($processes[$i]->id)}}"><strong>{{$processes[$i]->description}}@if($managers)
                                        <br> {{$managers[$i]->name}}-{{$managers[$i]->email}}@endif @if($candidatos)
                                        <br> {{$candidatos[$i]->name}}-{{$candidatos[$i]->email}}@endif</strong></a>
                            <br>
                            <br>
                            <h1>@if($processes[$i]->active == 1)
                                    To be evaluate
                                @else
                                    @if($results[$i] == 0)
                                        Refused
                                    @else Approved
                                    @endif
                                @endif</h1>
                        </div>
                        <br>
                    @endfor
                </div>
            </div>
            <div class="entire-screen">
                <div class="two-third-screen">

                </div>
                <div class="third-screen right">
                    @for($i = 1 ; $i <= $pags; $i++)
                        @if($i == $pags)
                            <button style="color:#272981;width: 10px;background-color: #eeeeee"
                                    value="{{$i}}-{{session('role')}}-{{session('userID')}}"
                                    onclick="ChangeProcesses(this.value)">{{$i}}</button>
                        @else
                            <button style="color:#272981;width: 10px;background-color: #eeeeee"
                                    value="{{$i}}-{{session('role')}}-{{session('userID')}}"
                                    onclick="ChangeProcesses(this.value)">{{$i}}-
                            </button>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="fifteen-screen">

        </div>
    </div>
@endsection
