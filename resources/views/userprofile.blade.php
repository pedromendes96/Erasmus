<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Erasmus teste</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Abhaya Libre' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<html>
<div class="entire-screen navbar">
    <div class="third-screen center">
        <a href="/"><img src="/img/erasmus.png" width="50%"></a>
    </div>
    <div class="two-third-screen right">
        <ul>
            <li>
                Home
            </li>
            <li>
                More Info
            </li>
            <li>
                Log In
            </li>
        </ul>
    </div>
</div>

<div class="entire-screen center" style="height: 80vh;background-image: url(/img/backgroundLogin.jpg);background-repeat: no-repeat;background-size:cover;margin-top: 103px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="fifteen-screen">

    </div>
    <div class="seventy-screen" style="padding: 0px 0px !important;border: 1px solid black;margin: 30px 0px;background-color: #eeeeee">
        <div class="entire-screen" style="margin: 50px 0px;padding: 0px 0px !important;">


        <div class="entire-screen" style="margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
                <div class="entire-screen center">
                    <br>
                    <h1>My profile: {{$user->name}}</h1>
                </div>
                <div class="entire-screen center">
                <img class="profile" width="100%" src="{{asset('storage/'.$user->img)}}">
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Role:
                    </div>
                    <div class="third-screen field-size left" >
                        {{$user->role}}
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Name:
                    </div> <div class="third-screen field-size left" >
                        {{$user->name}}
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Email:
                    </div><div class="third-screen field-size left">
                        {{$user->email}}
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Phone:
                    </div>
                <div class="third-screen field-size left" >
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
                <div class="third-screen field-size left" >
                    {{$user->city->name}}
                 </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Country:
                    </div> <div class="third-screen field-size left">
                        {{$user->country->name}}
                    </div>
                </div>
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        University:
                    </div> <div class="third-screen field-size left" >
                        {{$user->university->name}}
                    </div>
                </div>
                @if ($user->role == "student" or $user->role == "director")
                <div class="entire-screen center">
                    <div class="third-screen field-size">
                        Program:
                    </div> <div class="third-screen field-size left" >
                        {{$user->program->name}}
                    </div>
                </div>
                @endif
                <form method="POST" action="/dashboard/userprofile">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="userid" value="{{session('userid')}}">
                    <input type="hidden" name="role" value="{{session('role')}}">
                    <div class="entire-screen center">
                        <button class="main-button" type="submit" style="text-align:center">Edit Profile</button>
                    </div>
                </form>

        </div>
        </div>
    </div>


    <div class="entire-screen blue-theme">
        <div class="third-screen">
            <h5></h5>
        </div>
        <div class="third-screen center">
            <ul>
                <li>
                    <a href="#"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
        <div class="third-screen center">
            <h4>Copyright ERASMUS+</h4>
        </div>
    </div>
</div>
</html>
</body>
