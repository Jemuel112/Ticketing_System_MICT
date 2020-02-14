

@if($notify > 0)
    <script type="text/javascript">
        window.onload=function(){
            document.getElementById("my_audio").play();
        }
    </script>
    @endif

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

