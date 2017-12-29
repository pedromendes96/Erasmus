<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Erasmus</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Abhaya Libre' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
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
            <form style="padding: 25px 25px;"method="post" action="/resetpassword">
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
                    <input  type="password" placeholder="Confirm your new password" name="confirmpassword">
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
</body>
</html>