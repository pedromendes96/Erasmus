@extends('layouts.master')


@section ('content')
    <div id="mainSpace"></div>

    <section class="optionSection">

        <div class="option">
            <strong onclick="window.location='{{ url("dashboard/newProcess") }}'">New process</strong>
        </div>
        <div class="option">
            <strong onclick="window.location='{{ url("dashboard/process") }}'">My Processes</strong>
        </div>
        <div class="option">
            <strong onclick="window.location='{{ url("dashboard/settings") }}'">My Settings</strong>
        </div>
        <div class="option">
            <strong onclick="window.location='{{ url("dashboard/messages") }}'">My messages</strong>
        </div>

    </section>

@endsection