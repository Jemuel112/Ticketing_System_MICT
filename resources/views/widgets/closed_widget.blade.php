<div class="small-box bg-danger">
    <div class="inner">
        @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
            <h3>{{$tickets}}</h3>
        @else
            <h3>{{$utickets}}</h3>
        @endif
        <p>Closed Tickets</p>
    </div>
    <div class="icon">
        <i class="far fa-chart-pie"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
