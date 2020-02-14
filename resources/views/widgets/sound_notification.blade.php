{{--<audio src="Google_Event-1.mp3" id="my_audio"></audio>--}}
@if($notify > 0 && Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
<script type="text/javascript">
    window.onload=function(){
        var times = 10;
        var loop = setInterval(repeat, 2000);

        function repeat() {
            times--;
            if (times === 0) {
                clearInterval(loop);
            }

            var audio = document.createElement("audio");
            audio.src = "Google_Event-1.mp3";

            audio.play();
        }

        repeat();
    }
</script>
@endif
