@extends('layouts.master')



@section ('content')
    <div class="entire-screen ">

        <div class="seventy-screen" style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
            <div class="entire-screen">
                <br>
                <br>
                <br>
                <button onclick="window.location='{{ url("dashboard") }}'" class="quart-screen">BACK</button>
                <br>
                <br>
                <br>
                <h1 style="float: left">Select Process: {{ucfirst($user->role)}}</h1>
            </div>
            <div class="half-screen">

                @if($user->role != "student")
                    <h1> DONE</h1>
                    <input placeholder="Student's candidate ID">
                    <button>Search</button>
                @endif

                @foreach($processes as $process)
                    <div>
                        <h3 style="float: left">Process
                            {{$process->updated_at->day."/".$process->updated_at->month."/".$process->updated_at->year}} :
                            <strong @if($process->active==1)style="color: green" @else style="color: indianred"@endif >@if($process->active==1)Active @else Inactive @endif</strong>
                        </h3>
                    </div>
                    <br>
                    <br>
                    <div style="border: 2px solid #272981;text-align: center">
                        <br>
                        <br>
                        <a @if($user->role == 'manager' || $process->active==1)href="/dashboard/process/{{encrypt($process->id)}}" @endif><strong>{{$process->description}}</strong></a>
                        <br>
                        <br>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
@endsection