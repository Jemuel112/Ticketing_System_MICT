@extends('layouts.master')

@section('title', 'Dashboards | ')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            @if($errors->count()>0)
                                <div style="" class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        {{$error}} <br>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12">

                            <form action="{{route('dash.date')}}" class="float-right" method="POST">
                                @method('GET')
                                @csrf
                                <div class="input-group date" id="datetimepickers" data-target-input="nearest">
                                    <label for="date" style="padding-top: 5px">Month of: &nbsp;</label>
                                    <input type="text"
                                           class="form-control datetimepicker-input @error("start_at")is-invalid @enderror"
                                           @if(Session::has('date'))
                                           value="{{date('m/Y', strtotime(Session::get('date')))}}"
                                           @endif
                                           name="date"
                                           data-target="#datetimepickers"/>
                                    <div class="input-group-append" data-target="#datetimepickers"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <button class="btn btn-sm btn-secondary" type="submit">Submit</button>
                                </div>
                            </form>
                            <h1>Dashboard for the month of
                                <strong>@if(Session::has('date')) {{date('F Y', strtotime(Session::get('date')))}} @else {{\Carbon\Carbon::now()->format('F Y')}}  @endif</strong>
                            </h1>
                        </div>
                    </div>
                @else
                    <h1>Dashboard</h1>
                @endif

            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            @widget('active_widget')
                            <p>Active Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <form action="{{route('ticket.sort')}}" method="GET" class="small-box-footer">
                            <input type="text" name="status" value="Active" hidden>
                            <button class="btn btn-link"><span class="text-white">More Info <i
                                        class="fas fa-arrow-circle-right"></i></span></button>
                        </form>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            @widget('on_going_widget')
                            <p>On-Going Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <form action="{{route('ticket.sort')}}" method="GET" class="small-box-footer">
                            <input type="text" name="status" value="On-Going" hidden>
                            <button class="btn btn-link"><span class="text-dark">More Info <i
                                        class="fas fa-arrow-circle-right"></i></span></button>
                        </form>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            @widget('resolved_widget')
                            <p>Resolved Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <form action="{{route('ticket.sort')}}" method="GET" class="small-box-footer">
                            <input type="text" name="status" value="Resolve" hidden>
                            <button class="btn btn-link"><span class="text-white">More Info <i
                                        class="fas fa-arrow-circle-right"></i></span></button>
                        </form>
                    </div>

                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            @widget('closed_widget')
                            <p>Closed Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-chart-pie"></i>
                        </div>
                        <form action="{{route('ticket.sort')}}" method="GET" class="small-box-footer">
                            <input type="text" name="status" value="Closed" hidden>
                            <button class="btn btn-link"><span class="text-white">More Info <i
                                        class="fas fa-arrow-circle-right"></i></span></button>
                        </form>
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
                        <div class="card-body" style="overflow-x:auto;">
                            @asyncWidget('active_table')
                        </div>
                        <!-- /.card-body -->
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
                        <div class="card-body" style="overflow-x:auto;">
                            @asyncWidget('on_going_table')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('p-script')
    <script>
        $("#datetimepickers").datetimepicker({
            icons: {
                time: "far fa-clock",
            },
            viewMode: 'years',
            format: 'MM/YYYY'
        });
    </script>

@endsection
