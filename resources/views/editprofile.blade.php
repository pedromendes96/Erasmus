<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
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
        <input type="hidden" name="userid" value="{{$user->id}}">
        <input type="hidden" name="role" value="{{$user->role}}">
        <div class="entire-screen center">
            <button type="submit" class="main-button">Edit Profile</button>
        </div>
    </form>


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

