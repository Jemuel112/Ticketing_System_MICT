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
    <title>Received Calls Report | MCU Ticketing System</title>
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
                             style="opacity: .8; width: 50px"> MICT Received Calls Report
                        {{--                                <small class="pull-right"></small>--}}
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->

            <!-- <div class="row invoice-info"> -->
            <div class="container">

                <h3 class="p-2" style="text-align: center;"><strong>Department Recieved Calls ({{$range}})</strong></h3>

                <table
                    class="main_print compact table table-sm table-responsive-sm table-hover table-borderedless table-striped "
                    style="text-align: center;">
                    <thead>
                    <tr>
                        <th>Department</th>
                        <th>Active Tickets</th>
                        <th>On-Going Tickets</th>
                        <th>Resolved Tickets</th>
                        <th>Duplicate Tickets</th>
                        <th>Closed Tickets</th>
                        <th>Number of Call</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $ticket => $call)
                        <tr>
                            <td>{{$ticket}}</td>
                            <td>{{$call[0]}}</td>
                            <td>{{$call[1]}}</td>
                            <td>{{$call[2]}}</td>
                            <td>{{$call[3]}}</td>
                            <td>{{$call[4]}}</td>
                            <td>{{$call[0]+$call[1]+$call[2]+$call[3]+$call[4]}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"> No Results for {{$range}}</td>
                        </tr>
                    @endforelse
                    @empty(!$data)
                        <tr style="font-weight: bolder">
                            <td>Grand Total</td>
                            <td>{{$g_active}}</td>
                            <td>{{$g_on_going}}</td>
                            <td>{{$g_resolved}}</td>
                            <td>{{$g_dublicate}}</td>
                            <td>{{$g_closed}}</td>
                            <td>{{$g_active +  $g_on_going + $g_resolved + $g_dublicate + $g_closed}}</td>
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
