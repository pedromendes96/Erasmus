<div id ="directorstudent" class="entire-screen center">
    <div class="third-screen field-size">
        Program:
    </div>
    <div class="two-third-screen">
        <select name="program_id">
            <option disabled selected value>--select a program--</option>
            @foreach($programs as $program)
                <option value ="{{$program->id}}">{{$program->name}}</option>
            @endforeach
        </select>

    </div>
</div>