@extends('layouts.master')

@section('title', 'Create New Ticket | ')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <form action="#" id="myForm" method="POST" onload="functionToBeExecuted">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@{{ title }}</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                @if($errors->count()>0)
                    <div style="" class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}} <br>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- Main content -->
            @csrf
            @method('POST')
            <section class="content">
                <div class="card card-olive">
                    <div class="card-header">
                        <h3 class="card-title">Engineering Ticket Form</h3>
                        <div class="card-tools">
                            &nbsp;
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="fullname">
                            </div>
                            <div class="col-lg-3 col-md-3 form-group">
                                <label for="">Department</label>
                                <select class="form-control select2bs4 @error("request_by")is-invalid @enderror"
                                        id="reqb" name="request_by"
                                        style="width: 100%;">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 form-group">
                                <label for="">Quantity</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-lg-3 col-md-3 form-group">
                                <label for="">Equipment</label>
                                <input class="form-control" type="text">
                            </div>

                            <div class="col-lg-3 col-md-3 form-group">
                                <label for="">Service Type</label>
                                <select name="" id="" class="form-control select2bs4">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 form-group">
                                <label for="">Section</label>
                                <select name="" id="" class="form-control select2bs4"></select>
                            </div>
                            <div class="col-lg-3 col-md-3 form-group">
                                <label for="">Technician</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 form-group">
                                <label for="">Status</label>
                                <select name="" id="" class="form-control select2bs4"></select>
                            </div>
                            <div class="col-lg-4 col-md-4 form-group">
                                <label>Recieved Date</label>
                                    <div class="input-group date"
                                         data-target-input="nearest">
                                        <input type="text" name="created_at" id="datetimepicker1"
                                               class="form-control datetimepicker-input"
                                               data-target="#datetimepicker1">
                                        <div class="input-group-append" data-target="#datetimepicker1"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-4 col-md-4 form-group">
                                <label>Start Date</label>
                                <div class="input-group date"
                                     data-target-input="nearest">
                                    <input type="text" name="created_at" id="datetimepicker2"
                                           class="form-control datetimepicker-input"
                                           data-target="#datetimepicker2">
                                    <div class="input-group-append" data-target="#datetimepicker2"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 form-group">
                                <label>Due Date</label>
                                <div class="input-group date"
                                     data-target-input="nearest">
                                    <input type="text" name="finished_at" id="datetimepicker3"
                                           class="form-control datetimepicker-input"
                                           data-target="#datetimepicker3">
                                    <div class="input-group-append" data-target="#datetimepicker3"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 form-group">
                                <label for="">Service Request Details</label>
                                <textarea class="form-control" id="" rows="6" v-model="detailsBox"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 form-group">
                                <label for="">Remarks</label>
                                <textarea name="" id="" class="form-control" rows="4" v-model="remarksBox"></textarea>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
        </div>
        <!-- /.content -->
        <!-- /.content-wrapper -->

        @section('footer')
            <footer class="main-footer">
                <div id="ver">
                    <div class="float-right">
                        <b>Version</b> @{{ version }}
                        <button type="submit" form="myForm" style="margin-left: 10px" class="btn btn-primary"><i
                                class="nav-icon fal fa-plus-circle"></i>
                            Submit
                        </button>
                    </div>
                    <strong>Copyright &copy; @{{ year }} <a href="https://www.mcuhospital.org/">MCU
                            Hospital</a>.</strong> All
                    rights
                    reserved.
                </div>
            </footer>
        @endsection

    </form>
@endsection

@section('p-script')
    <script>
        const myForm = new Vue({
            el: '#myForm',
            data: {
                title: 'Create Ticket for Engineering',
                departments:{},
                detailsBox:'',
                remarksBox:'',
            }
        })
    </script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $("#datetimepicker1").datetimepicker({
            icons: {
                time: "far fa-clock"
            }
        });
        $("#datetimepicker2").datetimepicker({
            icons: {
                time: "far fa-clock"
            }
        });
        $("#datetimepicker3").datetimepicker({
            useCurrent: false,
            icons: {
                time: "far fa-clock"
            }
        });
        $("#datetimepicker2").on("change.datetimepicker", function (e) {
            $('#datetimepicker3').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker3").on("change.datetimepicker", function (e) {
            $('#datetimepicker2').datetimepicker('maxDate', e.date);
        });
    </script>
@endsection
