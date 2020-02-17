@if($notify > 0)
<audio autoplay>
    <source src="Google_Event-1.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
@endif

{{--@if($notify > 0)--}}
{{--    <audio src="Google_Event-1.mp3" id="my_audio" loop="loop"></audio>--}}

{{--    --}}{{--@if($notify > 0)--}}
{{--    --}}{{--    <script type="text/javascript">--}}
{{--    --}}{{--        window.onload=function(){--}}
{{--    --}}{{--            document.getElementById("my_audio").play();--}}
{{--    --}}{{--        }--}}
{{--    --}}{{--    </script>--}}
{{--@endif--}}
{{--<audio src="Google_Event-1.mp3" id="my_audio" loop="loop"></audio>--}}

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

