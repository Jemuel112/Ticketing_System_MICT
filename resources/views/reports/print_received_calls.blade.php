<!doctype html>
<html lang="en">
<head>
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
                        <th>Number of Call</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tickets as $ticket => $call)
                        <tr>
                            <td>{{$ticket}}</td>
                            <td>{{count($call)}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"> No Results for ({{$range}})</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr style="font-weight: bolder">
                        <td>Total</td>
                        <td>{{count($tickets)}}</td>
                    </tr>
                    </tfoot>
                </table>
                {{--                    <table class="">--}}

                {{--                    </table>--}}
                <table class="p-2 float-right">
                    <tbody style="font-size: 20px">
                    <tr>
                        <td><u>&nbsp;   {{Auth::user()->fname." ".Auth::user()->lname}}  &nbsp;</u></td>
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
