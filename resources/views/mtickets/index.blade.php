@extends('layouts.master')

@section('title', 'Create New Tickets | ')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <form action="/Create_MICT_Tickets" method="POST">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create Ticket</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            @csrf
            @method('POST')
            <section class="content">

                @if(Auth::user()->department == 'Administrator')
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Date</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Create At</label>
                                    <div class="form-group">
                                        <div class="input-group date"
                                             data-target-input="nearest">
                                            <input type="text" name="create_at" id="datetimepicker7"
                                                   class="form-control datetimepicker-input"
                                                   data-target="#datetimepicker7">
                                            <div class="input-group-append" data-target="#datetimepicker7"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Update Date</label>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <div class="input-group date"--}}
{{--                                             data-target-input="nearest">--}}
{{--                                            <input type="text" id="datetimepicker8"--}}
{{--                                                   class="form-control datetimepicker-input"--}}
{{--                                                   data-target="#datetimepicker8"/>--}}
{{--                                            <div class="input-group-append" data-target="#datetimepicker8"--}}
{{--                                                 data-toggle="datetimepicker">--}}
{{--                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                @endif


                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Ticket Info</h3>

                        {{--Date--}}
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                        {{--End Data--}}
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="row">


                            {{--Reportedy by--}}
                            <div class="col-lg-3 col-sm-3">
                                <label>Reported By</label>
                                <input class="form-control" style="width: 100%;" type="text" name="reported_by" placeholder="Name"
                                >
                            </div>
                            {{--End Reported by--}}


                            {{--Request by--}}
                            <div class="col-lg-3 col-sm-3">
                                <label for="reqb">Request By</label>
                                @if(Auth::user()->department == 'Administrator' || Auth::user()->department == "MICT")
                                    <select class="form-control select2bs4" id="reqb" name="request_by" style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                            <option
                                                value="{{$department->dept_name}}">{{$department->dept_name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control select2bs4" id="reqb" name="request_by"
                                            style="width: 100%;"
                                            disabled>
                                        <option
                                            value="{{Auth::user()->department}}" {{Auth::user()->department == Auth::user()->department  ? 'selected' : ''}} >{{Auth::user()->department}}</option>
                                    </select>
                                @endif
                            </div>
                            {{--End Request by--}}

                            {{--Status--}}
                            <div class="col-lg-3 col-sm-3">
                                <label>Status</label>
                                @if(Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT')
                                    <select class="form-control select2bs4" name="status"
                                            style="width: 100%;"
                                            id="status">
                                        <option value="Active" selected>Active</option>
                                        <option value="On-Going">On-Going</option>
                                        <option value="Resolve">Resolve</option>
                                        <option value="Duplicate">Duplicate</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                @else
                                    <select class="form-control select2bs4" name="status"
                                            style="width: 100%;"
                                            id="status"
                                            disabled>
                                        <option value="Active" selected>Active</option>
                                    </select>
                                @endif
                            </div>
                            {{--End Status--}}

                            {{--On-Going Status--}}
                            <div class="col-lg-3 col-sm-3">
                                <div id="dogs" hidden>
                                    <label for="ogs">On-Going Status</label>
                                    <select class="form-control select2bs4" name="og_status"
                                            id="ogs"
                                            style="width: 100%;"
                                            disabled
                                    >
                                        <option></option>
                                        <option value="1">Pending For Spare</option>
                                        <option value="2">Under Observation</option>
                                        <option value="3">Others</option>
                                    </select>
                                </div>
                            </div>
                            {{--End On-Going Status--}}


                            <div class="col-md-6" id="dogst1" hidden>
                                <label for="ogst"><br>Select Date to start</label>
                                <div class="input-group date" id="datetimepickers" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="start_at"
                                           data-target="#datetimepickers"/>
                                    <div class="input-group-append" data-target="#datetimepickers"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="dogst2" hidden>
                                <label for="ogst"><br>Select Deadline</label>
                                <div class="input-group date" id="datetimepickerd" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="end_at"
                                           data-target="#datetimepickerd"/>
                                    <div class="input-group-append" data-target="#datetimepickerd"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            {{--Acknoledge--}}
                            <div class="col-lg-3 col-md-3">
                                <label for="ackn"><br>Acknowledge by</label>
                                <select class="form-control select2bs4" id="ackn" name="acknowledge_by"
                                        style="width: 100%;"
                                        @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                        @else
                                        disabled
                                    @endif>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}">{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- End Acknoledge--}}

                            {{--Assigned--}}
                            <div class="col-lg-3 col-md-3">
                                <label><br>Assigned to</label>
                                <select class="form-control select2bs4" name="assigned_by"
                                        data-placeholder="Assigned to..."
                                        multiple="multiple" style="width: 100%;"
                                        @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                        @else
                                        disabled
                                    @endif>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}">{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--End Assigned--}}

                            {{--Assisted--}}
                            <div class="col-lg-3 col-md-3">
                                <label><br>Assisted By</label>
                                <select class="form-control select2bs4" name="assisted_by"
                                        data-placeholder="Assisted by..."
                                        multiple="multiple" style="width: 100%;"
                                        @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                        @else
                                        disabled
                                    @endif>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}">{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--End Assisted--}}

                            {{--Accompleshed--}}
                            <div class="col-lg-3 col-md-3">
                                <label><br>Accomplished by</label>
                                <select class="form-control select2bs4" name="accomplished_by"
                                        data-placeholder="Accomplished by..."
                                        multiple="multiple" style="width: 100%;"
                                        @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                        @else
                                        disabled
                                    @endif>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}">{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- End Accompleshed--}}

                            <div class="col-lg-4 col-md-4">
                                <label><br>Category</label>
                                <select class="form-control select2bs4" id="category" name="category"
                                        style="width: 100%;">
                                    <option></option>
                                    <option value="System">System</option>
                                    <option value="Software">Software</option>
                                    <option value="Hardware">Hardware</option>
                                    <option value="Network">Network</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>

                            {{--                        @if(Auth::user()->department == "Administrator"|| Auth::user()->department == "MICT")--}}
                            <div id="dother" class="col-lg-4 col-md-4" hidden>
                                <label><br>Others</label>
                                <input id="other"
                                       disabled
                                       class="form-control" style="width: 100%;" type="text" name=""
                                       placeholder="Please Specify"
                                >
                            </div>
                            {{--                        @endif--}}

                            @if(Auth::user()->department == "Administrator"|| Auth::user()->department == "MICT")
                                <div id="dsystem" class="col-lg-4 col-md-4" hidden>
                                    <label><br>System Category</label>
                                    <select id="system" class="form-control select2bs4" id="syscategory" name="sys_category"
                                            style="width: 100%;"
                                            disabled>
                                        {{--                                    <option></option>--}}
                                        <option>Bixbox</option>
                                        <option>PACS</option>
                                        <option>LIS - SYSMEX</option>
                                        <option>LIST - MARSMAN</option>
                                        <option>LIS - J&J</option>
                                        <option>DMS</option>
                                        <option>ACC PAC</option>
                                        <option>MEDEXPRESS</option>
                                        <option>ACCESS DB</option>
                                        <option>ASSET TRACER</option>
                                        <option>CHEQUE TRACER</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            @endif

                            @if(Auth::user()->department == "Administrator" || Auth::user()->departement == "MICT")
                                <div class="col-lg-4 col-md-4">
                                    <label><br>Level of Priority</label>
                                    <select class="form-control select2bs4" id="lop" name="lop"
                                            style="width: 100%;">
                                        <option></option>
                                        <option>Low</option>
                                        <option>Medium</option>
                                        <option>High</option>
                                    </select>
                                </div>
                            @endif

                            <div class="col-lg-12 col-md-12">
                                <label> <br>
                                    Issue / Concerns
                                </label>
                                <textarea name="concenrs" value="{{Auth::user()->fname}} {{Auth::user()->lanme}}"
                                          id="act" class="textarea" placeholder="Place some text here"
                                          style="width: 100%; height: 250px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples
                        and
                        information about
                        the plugin.
                    </div>
                </div>
                <div id="dact" hidden>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Actions Taken</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label></label>
                                    <textarea id="" class="textarea" placeholder="Place some text here"
                                              style="width: 100%; height: 250px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and
                            information about
                            the plugin.
                        </div>
                    </div>
                    <br>
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
    @include('layouts.scripts')
    <script type="text/javascript">
        $("#datetimepickers").datetimepicker();
        $("#datetimepickerd").datetimepicker({
            useCurrent: false
        });
        $("#datetimepickers").on("change.datetimepicker", function (e) {
            $('#datetimepickerd').datetimepicker('minDate', e.date);
        });
        $("#datetimepickerd").on("change.datetimepicker", function (e) {
            $('#datetimepickers').datetimepicker('maxDate', e.date);
        });
    </script>
    <script>

        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        // Summernote
        $('.textarea').summernote({
            height: 300,
            placeholder: 'Write here...',
        });
        $('#act').summernote('code');

        $selectElement = $('#reqb').select2({
            theme: 'bootstrap4',
            placeholder: "Select...",
            allowClear: true
        });
        $selectElement = $('#ackn').select2({
            theme: 'bootstrap4',
            placeholder: "Select...",
            allowClear: true
        });
        $selectElement = $('#ogs').select2({
            theme: 'bootstrap4',
            placeholder: "Select...",
            allowClear: true
        });
        $selectElement = $('#category').select2({
            theme: 'bootstrap4',
            placeholder: "Select Category",
            allowClear: true
        });
        $selectElement = $('#syscategory').select2({
            theme: 'bootstrap4',
            placeholder: "Select Category",
            allowClear: true
        });
        $selectElement = $('#lop').select2({
            theme: 'bootstrap4',
            placeholder: "Priority ",
            allowClear: true
        });
        $('#status').change(function () {
            if ($(this).val() == "On-Going") {
                $("#ogs").prop("disabled", false);
                $("#dogs").prop("hidden", false);
            } else {
                $("#ogs").prop("disabled", true);
                $("#dogs").prop("hidden", true);
            }
        });
        $('#status').change(function () {
            if ($(this).val() == "On-Going") {
                $("#dogst1").prop("disabled", false);
                $("#dogst1").prop("hidden", false);
                $("#dogst2").prop("disabled", false);
                $("#dogst2").prop("hidden", false);
            } else {
                $("#dogst1").prop("disabled", true);
                $("#dogst1").prop("hidden", true);
                $("#dogst2").prop("disabled", true);
                $("#dogst2").prop("hidden", true);
            }
        });
        $('#category').change(function () {
            if ($(this).val() == "System") {
                $("#system").prop("disabled", false);
                $("#dsystem").prop("hidden", false);
            } else {
                $("#system").prop("disabled", true);
                $("#dsystem").prop("hidden", true);
            }
        });
        $('#category').change(function () {
            if ($(this).val() == "Others") {
                $("#other").prop("disabled", false);
                $("#dother").prop("hidden", false);
            } else {
                $("#other").prop("disabled", true);
                $("#dother").prop("hidden", true);
            }
        });

        $('#status').change(function () {
            if ($(this).val() == "Closed") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else if ($(this).val() == "Resolve") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else {
                $("#act").prop("disabled", true);
                $("#dact").prop("hidden", true);
            }
        });
    </script>

@endsection


@section('footer',"<p></p>")
