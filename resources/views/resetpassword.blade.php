@extends('layouts.master')
@section('title','Erasmus - Account Recovery')


@section ('content')

    <div class="entire-screen center"
         style="background-image: url(/img/backgroundLogin.jpg);background-repeat: no-repeat;background-size:cover;margin-top: 103px;padding-right: 0px !important;padding-bottom: 0px !important;">
        <div class="fifteen-screen">

        </div>
        <div class="seventy-screen"
             style="padding: 0px 0px !important;border: 1px solid black;margin: 30px 0px;background-color: #eeeeee">
            <div class="entire-screen" style="margin: 50px 0px;padding: 0px 0px !important;">
                <form style="padding: 25px 25px;" method="post" action="/resetpassword">
                    {{csrf_field()}}
                    <div class="entire-screen center">
                        <br>
                        <h1>Account recovery:</h1>
                    </div>
                    <div class="entire-screen">
                        <label>Enter your email:</label>
                        <input type="email" placeholder="Your email" name="email">
                    </div>
                    <div class="entire-screen">
                        <label>New password:</label>
                        <input type="password" placeholder="Your new password" name="password">
                    </div>
                    <div class="entire-screen">
                        <label>Confirm new password:</label>
                        <input type="password" placeholder="Confirm your new password" name="confirmpassword">
                    </div>


                    @if (session('pwNotMatch'))
                        <div class="entire-screen">
                            <b> Passwords does not match!</b>
                        </div>
                    @endif
                    @if (session('userNotExists'))
                        <div class="entire-screen">
                            <b> Error! User does not exist!</b>
                        </div>
                    @endif

                    <div class="quart-screen">

                    </div>
                    <div class="half-screen center">
                        <button type="submit" class="main-button">Reset Password</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="fifteen-screen">

        </div>


    </div>
@endsection