<div class="entire-screen">
    <h1>Descobre as possiveis universidades que podes ir:</h1>
    <ul>
        @foreach($universities as $university)
            @foreach($addresses as $address)
                @if($address->id == $university->address_id)
                    <li class="normal-list"><i class="fa fa-university" aria-hidden="true"></i><a
                                style="text-decoration: underline;color: black;" target="_blank"
                                href="/university/{{$university->id}}">{{$university->name}}</a></li>
                @endif
            @endforeach
        @endforeach
    </ul>
</div>