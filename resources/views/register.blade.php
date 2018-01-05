@extends('layouts.master')
@section('title','Erasmus - Register')


@section ('content')



    <div class="entire-screen" style="margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
        <form action="/register" method="post">
            <div class="two-third-screen">
                <div class="entire-screen center">
                    <br>
                    <h1>Register</h1>
                </div>

                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Select your role:
                    </div>
                    <div class="two-third-screen">
                        <select name="role" id="role" required>
                            <option value="student" checked="checked">Student</option>
                            <option value="manager">Manager</option>
                            <option value="director">Course Director</option>
                        </select>
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Name:
                    </div>
                    <div class="two-third-screen">
                        <input type="text" name="name" required>
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Password:
                    </div>
                    <div class="two-third-screen">
                        <input type="password" name="password" required>
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Confirm Password:
                    </div>
                    <div class="two-third-screen">
                        <input type="password" name="confirmpassword" required>
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Email:
                    </div>
                    <div class="two-third-screen">
                        <input type="email" name="email" required>
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Phone:
                    </div>
                    <div class="two-third-screen">
                        <input type="text" name="phone" required>
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Country:
                    </div>
                    <div class="two-third-screen">
                        <select name="country" id="country" onchange="showUniversitiesC(this.value)" required>
                            <option disabled selected value>--select a country--</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        City:
                    </div>
                    <div class="two-third-screen">
                        <input type="text" name="city" required>
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Address:
                    </div>
                    <div class="two-third-screen">
                        <input type="text" name="address" required>
                    </div>
                </div>
                <div id="universities">

                </div>
                <div id="programs">

                </div>
                @if (session('phoneExists'))
                    <div class="entire-screen center">
                        <div class="third-screen field-size">

                        </div>
                        <div class="two-third-screen">
                            The phone number you inserted is already in use!
                        </div>
                    </div>
                @endif
                @if (session('emailExists'))
                    <div class="entire-screen center">
                        <div class="third-screen field-size">

                        </div>
                        <div class="two-third-screen">
                            The email you inserted is already in use!
                        </div>
                    </div>
                @endif
                @if (session('pwNotMatch'))
                    <div class="entire-screen center">
                        <div class="third-screen field-size">

                        </div>
                        <div class="two-third-screen">
                            The passwords does not match!
                        </div>
                    </div>
                @endif

                <div class="entire-screen center">
                    <button type="submit" style="text-align:center" class="main-button">Register</button>
                    <br>
                    <br>
                    <span><a href="/resetpassword">Forgot your password?</a></span>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
            <div class="third-screen aside">

            </div>
        </form>
    </div>

@endsection