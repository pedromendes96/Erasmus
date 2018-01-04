<div class="entire-screen center">
    <div class="third-screen field-size">
        University:
    </div>
    <div class="two-third-screen">
        <select id="university" name="university_id" onchange="showPrograms(this.value)">
            <option disabled selected value>--select a university--</option>
            @foreach($universities as $university)
                <option value="{{$university[0]->id}}">{{$university[0]->name}}</option>
            @endforeach
        </select>

    </div>
</div>


