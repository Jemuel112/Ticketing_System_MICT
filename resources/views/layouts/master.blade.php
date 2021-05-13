<!DOCTYPE html>
<html lang="eng">
<head>
    <!-- This System is created by Team MICT -->
    <!-- Special Thanks to Jemuel Amerila former MICT Staff (November 11, 2019 - May 24, 2021) ＼（＾○＾）人（＾○＾）／-->
    <!-- To God be the Glory -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')MCU Ticketing System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=2">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@include('layouts.css')
@include('layouts.scripts')
<!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
{{--<div id="app">--}}
{{--    <my-button></my-button>--}}
{{--</div>--}}

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
                <strong>Copyright &copy; @{{ year }} <a href="https://www.mcuhospital.org/">MCU
                        Hospital</a>.</strong>
                All rights
                reserved.
            </div>
        </footer>
    @endif
</div>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}

<script>
    new Vue({
        el: '#ver',
        data: {
            version: "0.1.0 (Beta)",
            year: "2019 - " + new Date().getFullYear() + " MICT Department",
        },
    });
    new Vue({
        el: '#endo',
        data: {
            newE: '',
        },
        mounted() {
            this.getCount()
        },
        methods: {
            getCount() {
                axios.get('/api/endorsements')
                    .then((response) => {
                        this.newE = response.data.new
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            }
        },
    })
    new Vue({
        el: '#logout',
        methods: {
            swalLogout() {
                Swal.fire({
                    title: 'Confirm Logout',
                    text: "Sure you want to logout?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Logout Successful',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        }).then(function () {
                            // $(window).preventDefault();
                            $(window).off("beforeunload");
                            window.location.href = "/logout"
                            // window.location.href = route('logout').url();

                        });
                    }
                });
            }
        }
    });
</script>
@yield('p-script')

{{--<script type="text/javascript">--}}
{{--    // window.location = "http://192.168.254.102:8080";--}}
{{--</script>--}}
{{--<!-- ./wrapper -->--}}
@include('sweetalert::alert')

</body>
</html>
