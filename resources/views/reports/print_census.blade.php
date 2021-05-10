<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Census Report for MICT| MCU Ticketing System</title>
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
                             style="opacity: .8; width: 50px"> Census Report for MICT
                        {{--                                <small class="pull-right"></small>--}}
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->

            <!-- <div class="row invoice-info"> -->
            <div class="container">

                <h3 class="p-2" style="text-align: center;"><strong>Census Reprot for ({{$range}})</strong></h3>
                {{--                    <table class="">--}}
                <table
                    class="main_print compact table table-sm table-responsive-sm table-hover table-borderedless table-striped "
                    style="text-align: center;">
                    <thead>
                    <tr>
                        <th>Staff</th>
                        <th>Active Tickets</th>
                        <th>On-Going Tickets</th>
                        <th>Resolved Tickets</th>
                        <th>Closed Tickets</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $micts as $key => $mict )
                        <tr>
                            <td>{{$mict->fname}}</td>
                            <td>{{$active[$key]}}</td>
                            <td>{{$on_going[$key]}}</td>
                            <td>{{$resolved[$key]}}</td>
                            <td>{{$closed[$key]}}</td>
                            <td>{{ $active[$key] + $on_going[$key] + $resolved[$key] + $closed[$key] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>Unassigned</td>
                        <td>{{$nactive}}</td>
                        <td>{{$non_going}}</td>
                        <td>{{$nresolved}}</td>
                        <td>{{$nclosed}}</td>
                        <td>{{ $nactive + $non_going + $nresolved + $nclosed }}</td>
                    </tr>
                    <tr style="font-weight: bolder">
                        <td>Grand Total</td>
                        <td>{{$nactive + $t_active}}</td>
                        <td>{{$non_going + $t_on_going}}</td>
                        <td>{{$nresolved + $t_resolved}}</td>
                        <td>{{$nclosed + $t_closed}}</td>
                        <td>{{ $nactive + $non_going + $nresolved + $nclosed + $t_active + $t_on_going + $t_resolved + $t_closed}}</td>
                    </tr>
                    </tbody>
                </table>

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
