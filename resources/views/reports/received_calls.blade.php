@extends('layouts.master')

@section('title', 'Department Received Calls | ')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Department Received Calls</h1>
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
                            <form action="{{route('report.received.calls')}}" class="" autocomplete="off" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-sm-6 col-lg-2" style="width: 100%;">
                                        <input type="text" class="form-control float-right" name="datefilter"
                                               placeholder="Date Range" value="{{request()->input('datefilter')}}">
                                    </div>
                                    <div class="col-sm-6 col-lg-2">
                                        <button type="submit" class="btn btn-warning col-12">Apply</button>
                                    </div>
                                </div>
                            </form>


                            {{--                            <form action="#" class="" autocomplete="off" method="GET">--}}
                            {{--                                @csrf--}}
                            {{--                                <div class="flex-column" style="width: 100%;">--}}
                            {{--                                    <div class="col-sm-3" style="width: 100%;">--}}
                            {{--                                        <input type="text" class="form-control float-right" name="datefilter"--}}
                            {{--                                               placeholder="Date Range" value="{{request()->input('datefilter')}}">--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-sm-3">--}}
                            {{--                                        <button type="submit" class="btn btn-warning col-12">Apply</button>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </form>--}}


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x:auto;">
                        </div>
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
