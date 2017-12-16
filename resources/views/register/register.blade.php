<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>$(document).ready(function(){
        $('#role').change(function(){
            selection = $(this).val();
            switch (selection){
                case 'studentmanager':
                    $('#studentmanager').show();
                    $('#director').hide();
                    break;
                case 'director':
                    $('#director').show();
                    $('#studentmanager').hide();
                    break;
                default:
                    $('#studentmanager').show();
                    $('#director').hide();
                    break;
            }
        });

        });</script>
</head>
<body>


<form action="/register/" method="POST">
    <label><b>Select your role:</b></label>
        <select name="role" id="role" required>
            <option value="student" checked ="checked">Student</option>
            <option value="manager">Manager</option>
            <option value="director">Course Director</option>
        </select>
        <br>
    <label><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" required>
    <br>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <br>
    <label><b>Confirm Password</b></label>
    <input type="password" placeholder="Enter Password" name="confirmpassword" required>
    <br>
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
    <br>
    <label><b>Phone</b></label>
    <input type="text" placeholder="Enter Phone" name="phone" required>
    <br>
    <label><b>Country</b></label>
    <select name="country"required>
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
    <div id = "studentmanager">
        <label><b>University</b></label>
            <select name="university_id">
                <option disabled selected value>--select an option--</option>
                    @foreach($universities as $university)
                   <option value ="{{$university->id}}">{{$university->name}}</option>
                    @endforeach
            </select>
    </div>

        <div id="director" style="display:none">
            <label><b>Program</b></label>
            <select name="program_id">
                <option disabled selected value>--select an option--</option>
                    @foreach($programs as $program)
                        <option value ="{{$program->id}}">{{$program->name}}</option>
                    @endforeach
            </select>
        </div>

        <button type="submit" style="text-align:center">Register</button>
        <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div style="background-color:#f1f1f1">
        <button type="button" class="cancelbutton">Cancel</button>
    </div>
</form>
</body>
</html>
