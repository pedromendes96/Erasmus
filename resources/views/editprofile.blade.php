@extends('layouts.master')
@section('title','Erasmus - Edit Settings')


@section ('content')

    <div class="entire-screen" style="margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">

        <div class="entire-screen center">
            <br>
            <h1>Edit Profile: {{$user->name}}</h1>
        </div>
        <form method="POST" action="/dashboard/settings/edit" enctype="multipart/form-data">
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Name:
                </div>
                <div class="two-third-screen left">
                    <input type="text" name="name" placeholder="{{$user->name}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Email:
                </div>
                <div class="two-third-screen left">
                    <input type="text" name="email" placeholder="{{$user->email}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Phone:
                </div>
                <div class="two-third-screen left">
                    <input type="text" name="phone" placeholder="{{$user->phone}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    New Password:
                </div>
                <div class="two-third-screen left">
                    <input type="password" name="password">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Confirm new Password:
                </div>
                <div class="two-third-screen left">
                    <input type="password" name="confirmpassword">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Country:
                </div>
                <div class="two-third-screen left">
                    <select name="country">
                        <option selected value="{{$user->country->id}}">{{$user->country->name}}</option>
                        @foreach($countries as $ctry)
                            @if ($user->country->id == $ctry->id){}
                            @else
                                <option value="{{$ctry->id}}">{{$ctry->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    City:
                </div>
                <div class="two-third-screen left">
                    <input type="text" name="city" placeholder="{{$user->city->name}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Address:
                </div>
                <div class="two-third-screen left">
                    <input type="text" name="address" placeholder="{{$user->address->name}}">
                </div>
            </div>
            <div class="entire-screen center">
                <div class="third-screen field-size">
                    Change profile image:
                </div>

                <div class="two-third-screen left">
                    <input class="left" style="display: inline-block;padding-top:15px;" type="file" name="image">
                </div>
            </div>
            @if (session('cityb4addr'))
                <div class="entire-screen center">
                    <div class="third-screen field-size">

                    </div>
                    <div class="two-third-screen">
                        <b>Please insert an address if u want to edit the city!</b>
                    </div>
                </div>
            @endif
            @if (session('notImg'))
                <div class="entire-screen center">
                    <b>The file you inserted is not an image type!</b>
                </div>
            @endif
            @if (session('phoneExists'))
                <div class="entire-screen center">
                    <b>The phone number you inserted is already in use!</b>
                </div>
            @endif
            @if (session('emailExists'))
                <div class="entire-screen center">
                    <b>The email address you inserted is already in use!</b>
                </div>
            @endif
            @if (session('pwNotMatch'))
                <div class="entire-screen center">
                    <b>The passwords you inserted does not match!</b>
                </div>
            @endif

            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="entire-screen center">
                <button type="submit" class="main-button">Edit Profile</button>
            </div>
        </form>

    </div>

@endsection