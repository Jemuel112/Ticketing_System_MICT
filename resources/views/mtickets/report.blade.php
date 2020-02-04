@extends('layouts.master')

@section('title', 'Service Report | ')
@include('layouts.scripts')

@section('content')
    <style>
        .main_print{border: 3px solid black;font-size: 19px}
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">

                <!-- title row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            <img src="../../img/MCU.png"
                                 alt="MCU Logo"
                                 class=" img-circle elevation-3"
                                 style="opacity: .8; width: 50px"> MICT Service Report
                            {{--                                <small class="pull-right"></small>--}}
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->

                <!-- <div class="row invoice-info"> -->

                <div class="container">

                    <h3><strong style="">Ticket # </strong>{{str_pad($ticket->id,5,'0',STR_PAD_LEFT)}}</h3>

                    <table class="table main_print">

                        <tr class="main_print">
                            <td colspan="2" class="main_print"><strong>Name and Department: </strong>{{$ticket->reported_by}} ({{$ticket->request_by}})</td>
                            <td class="main_print"  ><strong >Date:</strong>{{date('m/d/Y h:i A', strtotime(\Carbon\Carbon::now()))}}</td>
                        </tr>
                        <tr class="main_print">
                            <td colspan="3" style="text-align:center;"><strong>SERVICE DETAILS</strong>
                            </td>
                        </tr>

                        <tr class="main_print">
                            <td class="main_print"><strong>MICT Staff: </strong>
                                @php
                                    $selected = explode(",", $ticket->accomplished_by)
                                @endphp
                                @foreach($micts as $mict)
                                    {{ (in_array($mict->fname, $selected)) ? "($mict->fname) " : '' }}
                                @endforeach
                            </td>
                            <td class="main_print"><strong>Title: </strong>{{$ticket->category}} @if(!is_null($ticket->sys_category))({{$ticket->sys_category}})@endif</td>
                            <td class="main_print"><strong>Status: </strong>{{$ticket->status}}</td>
                        </tr>

                        <tr class="main_print">
                            <td colspan="3"><strong>Issues /
                                    Concerns: </strong>{{$ticket->concerns}}</td>
                        </tr>

                        <tr class="main_print">
                            <td colspan="3" ><strong>Services Rendered: </strong>
                                @foreach($actions as $action)
                                    @php
                                        $content = \App\mactions::find($action);
                                    @endphp
                                    {!!$content->actions!!}
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3"><strong>Remarks /
                                    Recommendations: </strong>{{$ticket->recommendation}}</td>
                        </tr>

                    </table>


                    <table class="table">
                        <tr>
                            <td><strong>Noted by:</strong></td>
                            <td><strong>Received by:</strong></td>
                        </tr>

                        <tr>
                            <td><strong><span style="border-bottom: solid 3px;font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mr. Cristeto L. Dela Cruz&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong>
                            </td>
                            <td><strong>______________________________________</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Signature Over Printed Name</strong></td>
                            <td><strong>Signature Over Printed Name</strong></td>
                        </tr>
                    </table>
                </div>
                <!-- / Container -->


                <!-- </div> -->
                <!-- /.row -->


            </section>
            <!-- /.content -->
        </div>


    </div>
@endsection

@section('footer')
    <div style="display: none">
        page header
    </div>
@endsection
