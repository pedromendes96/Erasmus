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
                Log Out
            </li>
        </ul>
    </div>
</div>
<div class="entire-screen center" style="background-image: url(/img/pexels-photo-288477.jpeg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="fifteen-screen">

    </div>
    <div class="seventy-screen" style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
        <div class="entire-screen" style="padding: 0px 0px !important;">
            <div class="quart-screen dashboard-option">
                <h1>Opcao</h1>
            </div>
            <div class="quart-screen dashboard-option">
                <h1>Opcao</h1>
            </div>
            <div class="quart-screen dashboard-option">
                <h1>Opcao</h1>
            </div>
            <div class="quart-screen dashboard-option">
                <h1>Opcao</h1>
            </div>
        </div>
        <div class="entire-screen">
            <h1>Message</h1>
        </div>
        <div>
            @if($id != $sender->id)
                <h2>From: {{$sender->name}}</h2>
            @else
                <h2>From: You</h2>
            @endif
            <input type="hidden" name="sender" value="{{$sender->id}}">
        </div>
        <div class="entire-screen">
            <div class="center"><h2>Subject:</h2></div>
            <h3>{{$message->subject}}</h3>
        </div>
        <div class="entire-screen" style="padding: 20px 20px;">
            <div class="center"><h2>Content:</h2></div>
            <h4>{{$message->content}}</h4>
        </div>
        @if($id != $sender->id)
            <div class="entire-screen">
                <div class="quart-screen"></div>
                <div class="half-screen"><a href="/dashboard/replymessage/{{$msg}}">Reply Message</a></div>
            </div>
        @endif
    </div>
    <div class="fifteen-screen">

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
</body>
</html>