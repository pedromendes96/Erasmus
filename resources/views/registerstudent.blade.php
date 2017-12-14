<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>


<form action="/register/student/" method="POST">
    <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="name" required>
        <br>
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br>
        <label><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <br>
        <label><b>Country</b></label>
        <select required>
            <option disabled selected value>--select a country--</option>
            @foreach($countries as $country)
                <option value ="{{$country->id}}">{{$country->name}}</option>
            @endforeach
        </select>
        <br>
        <label><b>City</b></label>
        <input type="text" placeholder="Enter City" name="city" required>
        <br>
        <label><b>Address</b></label>
        <input type="text" placeholder="Enter address" name="address" required>
        <br>
        <label><b>University</b></label>
        <select name="university_id" required>
        <option disabled selected value>--select an option--</option>
        @foreach($universities as $university)
            <option value ="{{$university->id}}">{{$university->name}}</option>
        @endforeach
        </select>
        <br>

        <button type="submit" style="text-align:center">Register</button>
        <input type="checkbox" checked="checked" name="remember_token" value="1"> Remember me
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </div>

    <div style="background-color:#f1f1f1">
        <button type="button" class="cancelbutton">Cancel</button>
        <span class="pw"><a href="#">Forgot your password?</a></span>
    </div>
</form>
</body>
</html>
</body>
</html>