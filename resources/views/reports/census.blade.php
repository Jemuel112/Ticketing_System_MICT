@extends('layouts.master')

@section('title', ' Census Report for MICT | ')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Census Report for MICT</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-cyan">
                        <div class="card-header">
                            {{--                            <h3 class="card-title">Active Tickets</h3>--}}
                            {{--                                <div class="card-tools col-sm-1">--}}
                            {{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i--}}
                            {{--                                            class="fas fa-minus"></i></button>--}}
                            {{--                                </div>--}}
                            <form action="{{route('report.census')}}" class="" autocomplete="off" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-sm-6 col-lg-2" style="width: 100%;">
                                        <input type="text" class="form-control float-right" name="datefilter"
                                               placeholder="Date Range" value="{{request()->input('datefilter')}}">
                                    </div>
                                    <div class="col-sm-6 col-lg-2">
                                        <button type="submit" class="btn btn-warning col-12">Generate</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-header -->
                        <section>
                            <div class="card-body" style="overflow-x:auto;">
                                @if(request()->input('datefilter'))
                                    @php
                                        $range = explode(' - ', request()->input('datefilter'));
                                        $range0 = date('F d, Y', strtotime($range[0]));
                                        $range1 = date('F d, Y', strtotime($range[1]));
                                    @endphp
                                    <h2 style="text-align: center;">Census Report fot ({{$range0 ." - ".$range1}})</h2>
                                    <div class="container">
                                        <table
                                            class="compact table table-sm table-responsive-sm table-hover table-borderedless table-striped "
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
                                                    <td>@if($active[$key] != 0) {{$active[$key]}} @endif</td>
                                                    <td>@if($on_going[$key] !=0) {{$on_going[$key]}} @endif</td>
                                                    <td>@if($resolved[$key] !=0) {{$resolved[$key]}} @endif</td>
                                                    <td>@if($closed[$key] !=0) {{$closed[$key]}} @endif</td>
                                                    <td>{{ $active[$key] + $on_going[$key] + $resolved[$key] + $closed[$key] }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>Unassigned</td>
                                                <td>@if($nactive !=0) {{$nactive}} @endif</td>
                                                <td>@if($non_going !=0) {{$non_going}} @endif</td>
                                                <td>@if($nresolved !=0) {{$nresolved}} @endif</td>
                                                <td>@if($nclosed !=0) {{$nclosed}} @endif</td>
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
                                        <a href="{{route('print.census')}}" target="_blank">
                                            <button class="btn btn-info float-right">Print Report</button>
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </section>
                        <!-- /.card-body -->
                        {{--                        <div class="card-footer">--}}
                        {{--                            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and--}}
                        {{--                            information about--}}
                        {{--                            the plugin.--}}
                        {{--                        </div>--}}
                    </div>
                </div>

            </div>
        </section>
    </div>

    <section>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2020 <a tabindex="1" href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong>
            All
            rights
            reserved.
        </footer>
    </section>
    @include('layouts.scripts')
    <script>
        $('input[name="datefilter"]').daterangepicker({
            showDropdowns: true,
            minYear: 2020,
            autoUpdateInput: false,
            autoclose: true,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    </script>
@endsection
