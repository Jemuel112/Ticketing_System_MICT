@if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
    <h3>{{$tickets}}</h3>
@else
    <h3>{{$utickets}}</h3>
@endif
