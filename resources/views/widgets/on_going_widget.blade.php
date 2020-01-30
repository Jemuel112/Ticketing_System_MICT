<div class="small-box bg-warning">
    <div class="inner">
        @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
            <h3>{{$tickets}}</h3>
        @else
            <h3>{{$utickets}}</h3>
       @endif
        <p>On-Going Tickets</p>
    </div>
    <div class="icon">
        <i class="fas fa-cogs"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
