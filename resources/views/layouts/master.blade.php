<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')MCU Ticketing System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=2">
@include('layouts.css')
@include('layouts.scripts')


<!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
@if(Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT')
    @asyncWidget('sound_notification')
@endif
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
            <div id="ver">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> @{{ version }}
                </div>
                <strong>Copyright &copy; @{{ year }} <a href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong>
                All rights
                reserved.
            </div>
        </footer>
    @endif
</div>

@yield('p-script')

<script type="text/javascript">
    // window.location = "http://192.168.254.102:8080";
</script>
<script>
    const ver = new Vue({
        el: '#ver',
        data: {
            version: "0.1.0 Testing",
            year: new Date().getFullYear(),
        }
    })
</script>
<!-- ./wrapper -->

</body>
</html>
