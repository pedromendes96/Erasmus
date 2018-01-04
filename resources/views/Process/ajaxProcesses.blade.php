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
        <h1>@if($processes[$i]->active == 1) To be evaluated @else @if($results[$i] == 0) Refused @else
                Approved @endif  @endif</h1>
        <br>
        <br>
    </div>
    <br>
@endfor