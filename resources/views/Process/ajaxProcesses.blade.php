@for($i = $min; $i < $max;$i++)
    <div>
        <h3 style="float: left">Process
            {{$processes[$i]->updated_at->day."/".$processes[$i]->updated_at->month."/".$processes[$i]->updated_at->year}}
            :
            <strong @if($processes[$i]->active==1)style="color: green"
                    @else style="color: indianred"@endif >@if($processes[$i]->active==1)Active @else
                    Inactive @endif</strong>
        </h3>
    </div>
    <br>
    <br>
    <div style="border: 2px solid #272981;text-align: center">
        <br>
        <br>
        <a @if($user->role == 'manager' || $processes[$i]->active==1)href="/dashboard/process/{{encrypt($processes[$i]->id)}}" @endif><strong>{{$processes[$i]->description}}</strong></a>
        <br>
        <br>
    </div>
    <br>
@endfor