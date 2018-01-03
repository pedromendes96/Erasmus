@extends('layouts.master')



@section ('content')
    <div class="entire-screen ">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <button onclick="window.location='{{ url("dashboard/process") }}'" class="quart-screen">BACK</button>
        <br>
        <br>
        <br>
        <div id="newProcess" class="half-screen">
            <h1 style="float: left">Edit Process: {{ucfirst($user->role)}}: {{$user->name}}</h1>
            <br>
            <br>
            <br>
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
                    <div id="approvedResult" hidden>Student process approved. This process is now inactive.</div>
                    <br>
                @endif
                <br>
            </div>

            <!-- EDIT DESTINATION -->
            @if($user->role == 'student')
                <div class="entire-screen">
                    <button id="editDestinationButton"><h5>Edit Destination</h5></button>
                    <br><br>
                    <div id="editDestinationOptions" hidden>
                        <form role="form" method="POST" action="/dashboard/editProcess">
                            {{ csrf_field() }}
                            <label for="country">Select Country destination:</label>
                            <select name="country" onchange="showCities(this.value)" required>
                                <option value="">---</option>
                            </select>
                            <br>
                            <label for="cities">Select City destination:</label>
                            <select name="city" required>//Correct the onChange!!!!!!!!!
                                <option value="">---</option>
                            </select>
                            <br>
                            <label for="universities">Select University destination:</label>
                            <select name="university" required>
                                <option value="">---</option>
                            </select>
                            <br>
                            <label for="semester">Select your desired Erasmus semester:</label>
                            <select name="semester">
                                <option value="">---</option>
                                <option value="1ºsemester">1ºSemester(Winter)</option>
                                <option value="2ºsemester">2ºSemester(Summer)</option>
                            </select>
                            <button type="submit">Save</button>
                        </form>
                        <hr>
                    </div>
                </div>
        @endif
        <!-- UPLOAD FILES -->
            <div class="entire-screen">
                <button id="uploadButton"><h5>Upload Files</h5></button>
                <br><br>
                <div class="entire-screen" id="uploadOptions" class="half-screen" hidden>
                    <form method="post" action="/dashboard/process/upload">
                        {{ csrf_field() }}
                        <input type="file" name="file1" id="uploadOption1" class="fileEvent" style="color: dimgrey;">
                        <strong>|-> Upload Learning Agreement</strong></input><br><br>
                        @if($user->role == 'student'/*If role is student, then can upload anything.*/)
                            <input type="file" name="file2" id="uploadOption2" class="fileEvent"
                                   style="color: dimgrey;">  <strong>|-> Upload Transcript Records</strong></input><br>
                            <br>
                            <input type="file" name="file3" id="uploadOption3" class="fileEvent"
                                   style="color: dimgrey;">  <strong>|-> Upload English Certificate</strong></input><br>
                            <br>
                            <input type="file" name="file4" id="uploadOption4" class="fileEvent"
                                   style="color: dimgrey;">  <strong>|-> Upload Profile Photo</strong></input><br><br>
                            <input type="file" name="file5" id="uploadOption5" class="fileEvent"
                                   style="color: dimgrey;">  <strong>|-> Upload ID Card</strong></input><br><br>
                            <input type="file" name="file6" id="uploadOption6" class="fileEvent"
                                   style="color: dimgrey;">  <strong>|-> Upload NIB declaration</strong></input><br><br>
                        @endif()
                        <button type="submit">Save Files</button>
                        <hr>
                    </form>
                </div>
            </div>
            <!-- DOWNLOAD FILES -->
            <div class="entire-screen">
                <button id="downloadButton"><h5>Download Files</h5></button>
                <br><br>
                <div id="downloadOptions" class="half-screen" hidden>
                    <form method="post" action="/dashboard/process/upload">
                        <a href="cdfvgbn" name="down1" id="downloadOption1" class="fileEvent"
                           style="color: dimgrey;"><strong>|-> Download Learning Agreement</strong></a><br><br>
                        @if($user->role != 'director'/*If role is manager or student, then can download anything.*/)
                            <a href="cdfvgbn" name="down2" id="downloadOption2" class="fileEvent"
                               style="color: dimgrey;"> <strong>|-> Download Transcript Records</strong></a><br><br>
                            <a href="cdfvgbn" name="down3" id="downloadOption3" class="fileEvent"
                               style="color: dimgrey;"> <strong>|-> Download English Certificate</strong></a><br><br>
                            <a href="cdfvgbn" name="down4" id="downloadOption4" class="fileEvent"
                               style="color: dimgrey;"> <strong>|-> Download Profile Photo</strong></a><br><br>
                            <a href="cdfvgbn" name="down5" id="downloadOption5" class="fileEvent"
                               style="color: dimgrey;"> <strong>|-> Download ID Card</strong></a><br><br>
                            <a href="cdfvgbn" name="down6" id="downloadOption6" class="fileEvent"
                               style="color: dimgrey;"> <strong>|-> Download NIB declaration</strong></a><br><br>
                        @endif()
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection