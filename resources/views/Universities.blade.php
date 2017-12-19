<div class="entire-screen">
    <h1>Descobre as possiveis universidades que podes ir:</h1>
    <ul>
        @foreach($universities as $university)
            <li class="normal-list"><i class="fa fa-university" aria-hidden="true"></i><a style="text-decoration: underline;color: black;" href="university/{{$university[0]->id}}">{{$university[0]->name}}</a></li>
        @endforeach
    </ul>
</div>