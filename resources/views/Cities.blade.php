<div class="entire-screen">
    <label>Cities:<br></label><select name="country">
        @foreach($cities as $city)
            <option value="{{$city->name}}">{{$city->name}}</option>
        @endforeach
    </select>
</div>