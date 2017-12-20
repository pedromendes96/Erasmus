<div class="entire-screen">
    <h1>Descobre as possiveis universidades que podes ir:</h1>
    <ul>
        @foreach($universities as $university)
            @foreach($university as $specuniversity)
                <li class="normal-list"><i class="fa fa-university" aria-hidden="true"></i><a style="text-decoration: underline;color: black;" href="university/{{$specuniversity->id}}">{{$specuniversity->name}}</a></li>
            @endforeach
        @endforeach
    </ul>
</div>