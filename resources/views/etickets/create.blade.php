@extends('layouts.master')

@section('title', 'Create New Ticket | ')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <!-- <form action="#" id="myForm" method="POST" onload="functionToBeExecuted"> -->

    <div class="content-wrapper" id="myForm">
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
                            <input v-model="name" class="form-control" type="text" name="name">
                        </div>
                        <div class="col-lg-3 col-md-3 form-group">
                            <label for="">Department</label>
                            <select id="dept" v-model="dept" class="form-control"
                                     style="width: 100%;" >
                                <option value=""></option>
                                <option v-for="dept in departments" v-bind:value="dept.id">@{{dept.dept_name}}</option>
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
                            <select id="service" class="form-control" style="width: 100%;">
                                <option value=""></option>
                                <option value="1">Check-up</option>
                                <option value="2">Fabrication</option>
                                <option value="3">Installation</option>
                                <option value="4">Preventive Maintenance</option>
                                <option value="5">Repainting</option>
                                <option value="6">Repair</option>
                                <option value="7">Replacement</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 form-group">
                            <label for="">Section</label>
                            <select id="section" class="form-control" style="width: 100%;">
                                <option value=""></option>
                                <option value="1">Carpentry</option>
                                <option value="2">Electrical</option>
                                <option value="3">Fab & Painting</option>
                                <option value="4">General Equipment</option>
                                <option value="5">Medical</option>
                                <option value="6">Plumbing</option>
                                <option value="7">Welding</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 form-group">
                            <label for="">Technician</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-3 form-group">
                            <label for="">Status</label>
                            <select id="status" class="form-control" style="width: 100%;">
                                <option value=""></option>
                                <option value="1">Active</option>
                                <option value="2">Hold</option>
                                <option value="3">Finish</option>
                            </select>
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
                                <input type="text" name="created_t" id="datetimepicker2"
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
                            <textarea class="form-control" rows="6" v-model="detailsBox"></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 form-group">
                            <label for="">Remarks</label>
                            <textarea class="form-control" rows="4" v-model="remarksBox"></textarea>
                        </div>
                        <div class="col-md-12">

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
                <!-- form="myForm" -->
                <button type="submit" style="margin-left: 10px" class="btn btn-primary"><i
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

<!-- </form> -->

@endsection

@section('p-script')
    <script>
        const myForm = new Vue({
            el: '#myForm',
            data: {
                title: 'Create Ticket for Engineering',
                departments: {},
                name:null,
                dept: null,
                qty:'',
                equipment:'',
                service:'',
                section:'',
                tech:'',
                status:'',
                rDate:'',
                sDate:'',
                dDate:'',
                detailsBox: '',
                remarksBox: '',
            },
            mounted() {
                this.getData();
            },
            methods: {
                getData() {
                    axios.get(`/api/departments`)
                        .then((response) => {
                            this.departments = response.data
                        })
                        .catch(function (error) {
                            console.log(error)
                        })
                },
            },
        });
    </script>
{{--    <script>--}}
{{--        // $('select').select2({--}}
{{--        //     theme: 'bootstrap4'--}}
{{--        // });--}}
{{--        $("#datetimepicker1").datetimepicker({--}}
{{--            icons: {--}}
{{--                time: "far fa-clock"--}}
{{--            }--}}
{{--        });--}}
{{--        $("#datetimepicker2").datetimepicker({--}}
{{--            icons: {--}}
{{--                time: "far fa-clock"--}}
{{--            }--}}
{{--        });--}}
{{--        $("#datetimepicker3").datetimepicker({--}}
{{--            useCurrent: false,--}}
{{--            icons: {--}}
{{--                time: "far fa-clock"--}}
{{--            }--}}
{{--        });--}}
{{--        $("#datetimepicker2").on("change.datetimepicker", function (e) {--}}
{{--            $('#datetimepicker3').datetimepicker('minDate', e.date);--}}
{{--        });--}}
{{--        $("#datetimepicker3").on("change.datetimepicker", function (e) {--}}
{{--            $('#datetimepicker2').datetimepicker('maxDate', e.date);--}}
{{--        });--}}
{{--    </script>--}}
@endsection
