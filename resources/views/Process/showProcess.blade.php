@extends('layouts.master')
@section('title','Erasmus - Process')

@section('content')
    <div class="entire-screen center"
         style="background-image: url(/img/pexels-photo-288477.jpeg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
        <div class="fifteen-screen">

        </div>
        <div class="seventy-screen"
             style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
            <div class="entire-screen center">
                <div class="quart-screen">

                </div>
                <div id="newProcess" class="half-screen">
                    <h1 style="float: left">Edit Process: {{ucfirst($user->role)}}: {{$user->name}}</h1>
                    <br>
                    <br>
                    <div class="center entire-screen" style="border: solid">
                        <br>
                        <i>Current selected destination:</i>
                        <br>
                        <b>{{$process->description}}</b>
                        <br>
                        <small @if($process->active==1)style="color: green"
                               @else style="color: indianred"@endif >@if($process->active==1)Active @else
                                Inactive @endif</small>
                        <br>
                        <small>Student: {{$student->name}} - {{$student->email}}</small>
                        <br>
                        <small>Manager: {{$manager->name}} - {{$manager->email}}</small>
                        <br>
                        @if($result)
                            @if($user->role == "student" and $process->active==0 and $result == 1)
                                <form method="post" action="http://localhost:8080/">
                                    <input type="hidden" name="origination" value="{{$origin}}">
                                    <input type="hidden" name="destination" value="{{$destiny}}">
                                    <input type="hidden" name="image" value="{{$img}}">
                                    <input type="hidden" name="personName" value="{{$name}}">
                                    <button>Chat</button>
                                </form>
                            @endif
                        @endif
                        @if($user->role=="manager" && $process->active==1)
                            <button id="approveResultButton">Evaluate Process</button>
                            <div id="approveResultOptions" class="entire-screen" hidden>
                                <strong class="center">Are you sure?</strong>
                                <br>
                                <div class="half-screen">
                                    <form role="form" method="POST" action="/dashboard/process/approve">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value={{$process->id}}>
                                        <input type="hidden" name="university" value="{{$user->university_id}}">
                                        <input type="hidden" name="result" value="refuse">
                                        <button type="submit" id="approveResultYes">Reject</button>
                                    </form>
                                </div>
                                <div class="half-screen">
                                    <form role="form" method="POST" action="/dashboard/process/approve">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value={{$process->id}}>
                                        <input type="hidden" name="university" value="{{$user->university_id}}">
                                        <input type="hidden" name="result" value="approve">
                                        <button type="submit" id="approveResultYes">Approve</button>
                                    </form>
                                </div>
                                <div class="entire-screen">
                                    <button id="approveResultNo">Cancel</button>
                                </div>
                            </div>
                            <div id="approvedResult" hidden>Student process approved. This process is now inactive.
                            </div>
                            <br>
                        @endif
                        <br>
                    </div>
                <!-- UPLOAD FILES -->
                    @if($user->role != "manager" && $process->active != 0 )
                        <div class="entire-screen">
                            <button id="uploadButton"><h5>Upload Files</h5></button>
                            <br><br>
                            <div class="left entire-screen" id="uploadOptions" class="half-screen" hidden>
                                <form method="post" action="/dashboard/process/upload" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="process_id" value="{{$process->id}}">
                                    <input type="file" name="file1" id="uploadOption1" class="fileEvent"
                                           style="color: dimgrey;">
                                    <strong>|-> Upload Learning Agreement</strong></input><br><br>
                                    @if($user->role == 'student'/*If role is student, then can upload anything.*/)
                                        <input type="file" name="file2" id="uploadOption2" class="fileEvent"
                                               style="color: dimgrey;">  <strong>|-> Upload Transcript
                                            Records</strong></input><br>
                                        <br>
                                        <input type="file" name="file3" id="uploadOption3" class="fileEvent"
                                               style="color: dimgrey;">  <strong>|-> Upload English
                                            Certificate</strong></input><br>
                                        <br>
                                        <input type="file" name="file4" id="uploadOption4" class="fileEvent"
                                               style="color: dimgrey;">  <strong>|-> Upload Profile
                                            Photo</strong></input>
                                        <br><br>
                                        <input type="file" name="file5" id="uploadOption5" class="fileEvent"
                                               style="color: dimgrey;">  <strong>|-> Upload ID Card</strong></input><br>
                                        <br>
                                        <input type="file" name="file6" id="uploadOption6" class="fileEvent"
                                               style="color: dimgrey;">  <strong>|-> Upload NIB
                                            declaration</strong></input>
                                        <br><br>
                                    @endif()
                                    <div class="center">
                                        <button type="submit">Save Files</button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    @endif
                    <!-- DOWNLOAD FILES -->
                    <div class="entire-screen">
                        <button id="downloadButton"><h5>Download Files</h5></button>
                        <br><br>
                        <div id="downloadOptions" class="entire-screen center" hidden>
                            @foreach ($files as $file)
                                <a href="{{asset($file)}}" target="_blank" class="fileEvent" style="color: dimgrey;">
                                    <strong>
                                        @if($file[strrpos($file, ".")-1] == 1 and $user->role != "director" )|->
                                        Download Learning Agreement
                                        @elseif($file[strrpos($file, ".")-1] == 2 and $user->role != "director")|->
                                        Download Transcript Records
                                        @elseif($file[strrpos($file, ".")-1] == 3 and $user->role != "director")|->
                                        Download English Certificate
                                        @elseif($file[strrpos($file, ".")-1] == 4 and $user->role != "director")|->
                                        Download Profile Photo
                                        @elseif($file[strrpos($file, ".")-1] == 5 and $user->role != "director")|->
                                        Download ID Card
                                        @elseif($file[strrpos($file, ".")-1] == 6 and $user->role != "director")|->
                                        Download NIB declaration
                                        @endif
                                    </strong>
                                </a><br>
                            @endforeach
                        </div>
                    </div>

                    @if(session('notPDF'))
                        <div class="entire-screen center" style="padding: 20px 20px;background-color: red;">
                            The submited file(s) are not PDF type.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection