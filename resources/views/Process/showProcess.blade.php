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
                        <small>Student: {{$student->name}}</small>
                        <br>
                        <small>Manager: {{$manager->name}}</small>
                        <br>
                        <small>Contact: {{$manager->email}}</small>
                        <br>
                        <br>
                        @if($user->role == "student" and $process->active==1)
                            <form method="post" action="http://localhost:8080/">
                                <input type="hidden" name="origination" value="{{$origin}}">
                                <input type="hidden" name="destination" value="{{$destiny}}">
                                <input type="hidden" name="image" value="{{$img}}">
                                <input type="hidden" name="personName" value="{{$name}}">
                                <button>Chat</button>
                            </form>
                        @endif
                        @if($user->role=="manager" && $process->active==0)
                            <button id="approveResultButton">Approve Student Process</button>
                            <div id="approveResultOptions" class="entire-screen" hidden>
                                <strong class="center">Are you sure?</strong>
                                <br>
                                <div class="half-screen">
                                    <button id="approveResultNo">Cancel</button>
                                </div>
                                <div class="half-screen">
                                    <form role="form" method="POST" action="/dashboard/process/approve">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value={{$process->id}}>
                                        <button type="submit" id="approveResultYes">Approve</button>
                                    </form>
                                </div>
                            </div>
                            <div id="approvedResult" hidden>Student process approved. This process is now inactive.
                            </div>
                            <br>
                        @endif
                        <br>
                    </div>

                {{--<!-- EDIT DESTINATION -->--}}
                {{--@if($user->role == 'student')--}}
                {{--<div class="entire-screen">--}}
                {{--<button id="editDestinationButton"><h5>Edit Destination</h5></button>--}}
                {{--<br><br>--}}
                {{--<div id="editDestinationOptions" hidden>--}}
                {{--<form role="form" method="POST" action="/dashboard/editProcess">--}}
                {{--{{ csrf_field() }}--}}
                {{--<label for="country">Select Country destination:</label>--}}
                {{--<select name="country" onchange="showCities(this.value)" required>--}}
                {{--<option value="">---</option>--}}
                {{--</select>--}}
                {{--<br>--}}
                {{--<label for="cities">Select City destination:</label>--}}
                {{--<select name="city" required>//Correct the onChange!!!!!!!!!--}}
                {{--<option value="">---</option>--}}
                {{--</select>--}}
                {{--<br>--}}
                {{--<label for="universities">Select University destination:</label>--}}
                {{--<select name="university" required>--}}
                {{--<option value="">---</option>--}}
                {{--</select>--}}
                {{--<br>--}}
                {{--<label for="semester">Select your desired Erasmus semester:</label>--}}
                {{--<select name="semester">--}}
                {{--<option value="">---</option>--}}
                {{--<option value="1ºsemester">1ºSemester(Winter)</option>--}}
                {{--<option value="2ºsemester">2ºSemester(Summer)</option>--}}
                {{--</select>--}}
                {{--<button type="submit">Save</button>--}}
                {{--</form>--}}
                {{--<hr>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--@endif--}}
                <!-- UPLOAD FILES -->
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
                                           style="color: dimgrey;">  <strong>|-> Upload Profile Photo</strong></input>
                                    <br><br>
                                    <input type="file" name="file5" id="uploadOption5" class="fileEvent"
                                           style="color: dimgrey;">  <strong>|-> Upload ID Card</strong></input><br><br>
                                    <input type="file" name="file6" id="uploadOption6" class="fileEvent"
                                           style="color: dimgrey;">  <strong>|-> Upload NIB declaration</strong></input>
                                    <br><br>
                                @endif()
                                <div class="center">
                                    <button type="submit">Save Files</button>
                                </div>
                                <hr>
                            </form>
                        </div>
                    </div>
                    <!-- DOWNLOAD FILES -->
                    <div class="entire-screen">
                        <button id="downloadButton"><h5>Download Files</h5></button>
                        <br><br>
                        <div id="downloadOptions" class="entire-screen center" hidden>
                            @foreach ($files as $key => $file)
                                @if($key == 0)
                                    <a href="{{asset($file)}}" target="_blank" class="fileEvent"
                                       style="color: dimgrey;"><strong>Download Learning Agreement </strong></a><br>
                                @endif()
                                @if($key != 0 && $user->role != 'director'/*If role is manager or student, then can download anything.*/)
                                    <a href="{{asset($file)}}" target="_blank" class="fileEvent"
                                       style="color: dimgrey;">
                                        <strong>
                                            @if($key == 1)Download Transcript Records<br>
                                            @elseif($key == 2)Download English Certificate<br>
                                            @elseif($key == 3)Download Profile Photo<br>
                                            @elseif($key == 4)Download ID Card<br>
                                            @elseif($key == 5)Download NIB declaration<br>
                                            @endif
                                        </strong>
                                    </a>
                                @endif
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