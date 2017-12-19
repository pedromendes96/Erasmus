<div class="entire-screen">
    <label>Cities:<br></label><select name="country" onchange="showUniversities(this.value)">
        <option style="display:none;" selected>Select City</option>
        @foreach($cities as $city)
            <option value="{{$city->id}}">{{$city->name}}</option>
        @endforeach
    </select>
</div>