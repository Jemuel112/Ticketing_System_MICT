<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')MCU Ticketing System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=2">
@include('layouts.css')
<!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

{{--<audio src="Google_Event-1.mp3" id="my_audio" loop="loop"></audio>--}}
{{--<script type="text/javascript">--}}
{{--    window.onload=function(){--}}
{{--        document.getElementById("my_audio").play();--}}
{{--    }--}}
{{--</script>--}}
@if(Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT')
@widget('sound_notification')
@endif
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
<!-- Site wrapper -->
<div class="wrapper">



@include('layouts.mict_header')

@hasSection('nav')
@else
    @include('layouts.mict_nav')
@endif
@yield('content')

<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        {{--                <h1>Sample Text</h1>--}}
    </aside>
    <!-- /.control-sidebar -->
    @hasSection('footer')
        @yield('footer')
    @else
        <footer class="main-footer">
{{--            <audio id="audio" src="https://file-examples.com/wp-content/uploads/2017/11/file_example_MP3_700KB.mp3"></audio>--}}

{{--            <audio id="audio" src="Google_Event-1.mp3"></audio>--}}
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2020 <a href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong> All rights
            reserved.
        </footer>
    @endif
</div>
<!-- ./wrapper -->

</body>
</html>
