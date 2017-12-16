<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="/login/">
        <label><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <br>
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="submit" >Login</button>
    </form>
</body>

</html>