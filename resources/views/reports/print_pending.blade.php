<!doctype html>
<html lang="en">
<head>
    <!-- This System is created by Team MICT -->
    <!-- Special Thanks to Jemuel Amerila former MICT Staff (November 11, 2019 - May 24, 2021) ＼（＾○＾）人（＾○＾）／-->
    <!-- To God be the Glory -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List of Pending Tickets | MCU Ticketing System</title>
</head>
<body>
@include('layouts.css')

<style>
    .main_print {
        border: 3px solid black;
        font-size: 18px;
    }

    u {
        text-decoration: none;
        border-bottom: 3px solid black;
    }

    @media print {
        body {
            background-color: #FFFFFF;
            background-image: none;
            color: #000000
        }

        #ad {
            display: none;
        }

        #leftbar {
            display: none;
        }

        #contentarea {
            width: 100%;
        }
    }
</style>
<script>
    window.onload = function () {
        window.print();
    };
</script>

<!-- Content Wrapper. Contains page content -->
<div class="">
    <div class="">
        <!-- Main content -->
        <section class="invoice" onload="window.print()">
            <!-- title row -->
            <div class="">
                <div class="">
                    <h2 class="page-header p-3" style="text-align: center;">
                        <img src="../../img/MCU.png"
                             alt="MCU Logo"
                             class=" img-circle elevation-3"
                             style="opacity: .8; width: 50px"> List of Pending Report
                        {{--                                <small class="pull-right"></small>--}}
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->

            <!-- <div class="row invoice-info"> -->
            <div class="container">

                <h3 class="p-2" style="text-align: center;"><strong>List of Pending Reports ({{$range}})</strong></h3>

                <table
                    class="main_print compact table table-sm table-responsive-sm table-hover table-borderedless table-striped "
                    style="text-align: center;">
                    <thead>
                    <tr>
                        <th>Department</th>
                        <th>Active Tickets</th>
                        <th>On-Going Tickets</th>
                        <th>Total Of Tickets</th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $ticket => $call)
                        <tr>
                            <td>{{$ticket}}</td>
                            <td>@(if$call[0] != 0){{$call[0]}} @endif</td>
                            <td>@(if$call[1] != 0){{$call[1]}} @endif</td>
                            <td>{{$call[0]+$call[1]}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10"> No Results for {{$range}}</td>
                        </tr>
                    @endforelse
                    @empty(!$data)
                        <tr style="font-weight: bolder">
                            <td>Grand Total</td>
                            <td>{{$g_active}}</td>
                            <td>{{$g_on_going}}</td>
                            <td>{{$g_active +  $g_on_going}}</td>
                        </tr>
                    @endempty
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                {{--                    <table class="">--}}

                {{--                    </table>--}}
                <table class="p-2 float-right">
                    <tbody style="font-size: 20px">
                    <tr>
                        <td><u>&nbsp; {{Auth::user()->fname." ".Auth::user()->lname}} &nbsp;</u></td>
                    </tr>
                    </tbody>
                    <tfoot style="font-weight: bolder; font-size: 20px; text-align: center">
                    <tr>
                        <td>Prepared By</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- / Container -->
            <!-- </div> -->
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
</div>
</body>
</html>