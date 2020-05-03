@if($notify > 0)
    <audio autoplay>
        <source src="{{asset('Google_Event-1.mp3')}}" type="audio/mpeg">
    </audio>
@elseif($myActive>0)
    <audio autoplay>
        <source src="{{asset('my_active_alarm.mp3')}}" type="audio/mpeg">
    </audio>
@endif
