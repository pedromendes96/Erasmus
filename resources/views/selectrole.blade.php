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


<form action="/register/" method="POST">
    <label><b>Select your role:</b></label>
        <select name="role" required>
            <option value="student" checked ="checked">Student</option>
            <option value="manager">Manager</option>
            <option value="student">Course Director</option>
        </select>
        <br>

        <button type="submit" style="text-align:center">Ok</button>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </div>

    <div style="background-color:#f1f1f1">
        <button type="button" class="cancelbutton">Cancel</button>
    </div>
</form>
</body>
</html>
</body>
</html>