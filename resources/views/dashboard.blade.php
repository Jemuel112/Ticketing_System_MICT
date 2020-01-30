@extends('layouts.master')

@section('title', 'Dashboard | ')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                <h3>{{\App\mTicket::where('status', '=', 'Active')->count() }}</h3>
                            @else
                                <h3>{{\App\mTicket::where('request_by','=',\Illuminate\Support\Facades\Auth::user()->department)->where('status', '=','Active')->count() }}</h3>
                            @endif
                            <p>Active Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                <h3>{{\App\mTicket::where('status', '=', 'On-Going')->count() }}</h3>
                            @else
                                <h3>{{\App\mTicket::where('request_by','=',\Illuminate\Support\Facades\Auth::user()->department)->where('status', '=','On-Going')->count() }}</h3>
                            @endif
                            <p>On-Going Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                <h3>{{\App\mTicket::where('status', '=', 'Resolve')->count() }}</h3>
                            @else
                                <h3>{{\App\mTicket::where('request_by','=',\Illuminate\Support\Facades\Auth::user()->department)->where('status', '=','Resolve')->count() }}</h3>
                            @endif
                            <p>Resolved Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                <h3>{{\App\mTicket::where('status', '=', 'Closed')->count() }}</h3>
                            @else
                                <h3>{{\App\mTicket::where('request_by','=',\Illuminate\Support\Facades\Auth::user()->department)->where('status', '=','Closed')->count() }}</h3>
                            @endif
                            <p>Closed Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-chart-pie"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-cyan">
                        <div class="card-header">
                            <h3 class="card-title">Active Tickets</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                            </div>
                        </div>
                        <!-- /.card-body -->
                        {{--                        <div class="card-footer">--}}
                        {{--                            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and--}}
                        {{--                            information about--}}
                        {{--                            the plugin.--}}
                        {{--                        </div>--}}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-yellow">
                        <div class="card-header">
                            <h3 class="card-title">On-Going Tickets</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                            </div>
                        </div>
                        <!-- /.card-body -->
                        {{--                        <div class="card-footer">--}}
                        {{--                            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and--}}
                        {{--                            information about--}}
                        {{--                            the plugin.--}}
                        {{--                        </div>--}}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-green">
                        <div class="card-header">
                            <h3 class="card-title">Resolved Tickets</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                            </div>
                        </div>
                        <!-- /.card-body -->
                        {{--                        <div class="card-footer">--}}
                        {{--                            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and--}}
                        {{--                            information about--}}
                        {{--                            the plugin.--}}
                        {{--                        </div>--}}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-red">
                        <div class="card-header">
                            <h3 class="card-title">Closed Tickets</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                            </div>
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

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2020 <a tabindex="1" href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong> All
        rights
        reserved.
    </footer>
    @include('layouts.scripts')

@endsection
