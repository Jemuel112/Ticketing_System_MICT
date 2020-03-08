@extends('layouts.master')

@section('title', 'View Ticket | ')
@include('layouts.scripts')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <form action='' method="POST" id="myForm">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>My Endorsement</h1>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            @csrf
            @method('POST')
            <section class="content" onload="functionToBeExecuted">
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Ticket Info</h3>
                        <div class="card-tools">
                            &nbsp;
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                        {{--End Data--}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row"></div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content -->
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right">
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
            <strong>Copyright &copy; 2020 <a href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong> All
            rights
            reserved.
            <b>Version</b> 1.0.0
        </footer>

    </form>

@endsection


@section('footer',"<p></p>")
