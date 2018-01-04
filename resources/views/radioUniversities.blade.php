<div class="entire-screen">
    <h1>Descobre as possiveis universidades que podes ir:</h1>
    @foreach($universities as $university)
        @foreach($addresses as $address)
            @if($address->id == $university->address_id)
                <input type="radio" value="{{$university->id}}" name="university"><a
                        style="text-decoration: underline;color: black;" target="_blank"
                        href="/university/{{$university->id}}">{{$university->name}}</a>
                <br>
            @endif
        @endforeach
    @endforeach
    <br>
    <br>
</div>