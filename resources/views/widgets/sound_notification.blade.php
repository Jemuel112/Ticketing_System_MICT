{{--<audio src="Google_Event-1.mp3" id="my_audio" loop="loop"></audio>--}}

{{--@for ($i = 0; $i < 2; $i++)--}}
@while (true)
    <audio autoplay hidden>
        <source src="Google_Event-1.mp3" type="audio/mpeg">
    </audio>
@endwhile

{{--@endfor--}}

{{--    <script type="text/javascript">--}}
{{--        window.onload=function(){--}}
{{--            document.getElementById("my_audio").play();--}}
{{--        }--}}
{{--    </script>--}}


{{--<script type="text/javascript">--}}
{{--    window.onload=function(){--}}
{{--        var times = 10;--}}
{{--        var loop = setInterval(repeat, 2000);--}}

{{--        function repeat() {--}}
{{--            times--;--}}
{{--            if (times === 0) {--}}
{{--                clearInterval(loop);--}}
{{--            }--}}

{{--            var audio = document.createElement("audio");--}}
{{--            audio.src = "Google_Event-1.mp3";--}}

{{--            audio.play();--}}
{{--        }--}}

{{--        repeat();--}}
{{--    }--}}
{{--</script>--}}

