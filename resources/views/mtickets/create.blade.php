@extends('layouts.master')

@section('title', 'Create New Tickets | ')
    @include('layouts.scripts')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <form action="/MICT-Tickets" method="POST">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create Tickets</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                {{--            SHOW USERS ERRORS--}}
                @if($errors->count()>0)
                    <div style="" class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}} <br>
                        @endforeach
                    </div>
                @endif
                {{--            END SHOW USERS ERRORS--}}
            </section>

            <!-- Main content -->
            @csrf
            @method('POST')
            <section class="content" onload="functionToBeExecuted">

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
                                            <input type="text" name="created_at" id="datetimepicker7"
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
                                <label>Reported by
                                </label>
                                <input class="form-control @error("reported_by")is-invalid @enderror"
                                       value="{{old('reported_by')}}"
                                       style="width: 100%;" type="text" name="reported_by" placeholder="Name"
                                >
                            </div>
                            {{--End Reported by--}}


                            {{--Request by--}}
                            <div class="col-lg-3 col-sm-3">
                                <label for="reqb">Request By</label>
                                @if(Auth::user()->department == 'Administrator' || Auth::user()->department == "MICT")
                                    <select class="form-control select2bs4 @error("request_by")is-invalid @enderror"
                                            id="reqb" name="request_by"
                                            style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                            <option
                                                value="{{$department->dept_name}}" {{ old('request_by') == $department->dept_name ? 'selected':''}}>{{$department->dept_name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control select2bs4 @error("request_by")is-invalid @enderror"
                                            value="{{old('request_by')}}"
                                            id="reqb" name="request_by"
                                            style="width: 100%;"
                                    >
                                        <option
                                            value="{{Auth::user()->department}}">{{Auth::user()->department}}</option>
                                    </select>
                                @endif
                            </div>
                            {{--End Request by--}}

                            {{--Status--}}
                            <div class="col-lg-3 col-sm-3">
                                <label>Status</label>
                                @if(Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT')
                                    <select class="form-control select2bs4 @error("status")is-invalid @enderror"
                                            name="status"
                                            style="width: 100%;"
                                            id="status">
                                        <option value="Active" {{ old('status') == 'Active' ? 'selected' :''}}>Active
                                        </option>
                                        <option value="On-Going" {{ old('status') == 'On-Going' ? 'selected':''}}>
                                            On-Going
                                        </option>
                                        <option value="Resolve" {{ old('status') == 'Resolve' ? 'selected':''}}>Resolve</option>
                                        <option value="Duplicate" {{ old('status') == 'Duplicate' ? 'selected':''}}>Duplicate</option>
                                        <option value="Closed" {{ old('status') == 'Closed' ? 'selected':''}}>Closed</option>
                                    </select>
                                @else
                                    <select class="form-control select2bs4 @error("status")is-invalid @enderror"
                                            name="status"
                                            style="width: 100%;"
                                            id="status"
                                    >
                                        <option value="Active" selected>Active</option>
                                    </select>
                                @endif
                            </div>
                            {{--End Status--}}

                            {{--On-Going Status--}}
                            <div class="col-lg-3 col-sm-3">
                                <div id="dogs" hidden>
                                    <label for="ogs">On-Going Status</label>
                                    <select class="form-control select2bs4 @error("og_status")is-invalid @enderror"
                                            name="og_status"
                                            id="ogs"
                                            style="width: 100%;"
                                            disabled
                                    >
                                        <option></option>
                                        <option value="Pending For Spare" {{ old('og_status') == 'Pending For Spare' ? 'selected':''}}>Pending For Spare</option>
                                        <option value="Under Observation" {{ old('og_status') == 'Under Observation' ? 'selected':''}}>Under Observation</option>
                                        <option value="Others" {{ old('og_status') == 'Others' ? 'selected':''}}>Others</option>
                                    </select>
                                </div>
                            </div>
                            {{--End On-Going Status--}}


                            <div class="col-md-6" id="dogst1" hidden>
                                <label for="ogst"><br>Select Date to start</label>
                                <div class="input-group date" id="datetimepickers" data-target-input="nearest">
                                    <input type="text"
                                           class="form-control datetimepicker-input @error("start_at")is-invalid @enderror"
                                           value="{{old('start_at')}}" name="start_at"
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
                                    <input type="text"
                                           class="form-control datetimepicker-input @error("end_at")is-invalid @enderror"
                                           value="{{old('end_at')}}" name="end_at"
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
                                <select class="form-control select2bs4 @error("acknowledge_by")is-invalid @enderror"
                                        value="{{old('acknowledge_by')}}" id="ackn" name="acknowledge_by"
                                        style="width: 100%;"
                                        @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                        @else
                                        disabled
                                    @endif>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}" {{ old('acknowledge_by') == $mict->fname ? 'selected':''}}>{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- End Acknoledge--}}

                            {{--Assigned--}}
                            <div class="col-lg-3 col-md-3">
                                <label><br>Assigned to</label>
                                <select class="form-control select2bs4 @error("assigned_to")is-invalid @enderror"
                                        value="{{old('assigned_to')}}" name="assigned_to"
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
                                <select class="form-control select2bs4 @error("assisted_by")is-invalid @enderror"
                                        value="{{old('assisted_by')}}" name="assisted_by"
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
                                <select class="form-control select2bs4 @error("accomplished_by")is-invalid @enderror"
                                        value="{{old('accomplished_by')}}" name="accomplished_by"
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
                                <select class="form-control select2bs4 @error("category")is-invalid @enderror"
                                        id="category" name="category"
                                        style="width: 100%;">
                                    <option></option>
                                    <option value="System" {{ old('category') == 'System' ? 'selected':''}}>System</option>
                                    <option value="Software" {{ old('category') == 'Software' ? 'selected':''}}>Software</option>
                                    <option value="Hardware" {{ old('category') == 'Hardware' ? 'selected':''}}>Hardware</option>
                                    <option value="Network" {{ old('category') == 'Network' ? 'selected':''}}>Network</option>
                                    <option value="Others" {{ old('category') == 'Others' ? 'selected':''}}>Others</option>
                                </select>
                            </div>

                            {{--                        @if(Auth::user()->department == "Administrator"|| Auth::user()->department == "MICT")--}}
                            <div id="dother" class="col-lg-4 col-md-4" hidden>
                                <label><br>Others</label>
                                <input id="other"
                                       disabled
                                       class="form-control @error("other")is-invalid @enderror" value="{{old('other')}}"
                                       name="other" style="width: 100%;" type="text" name=""
                                       placeholder="Please Specify"
                                >
                            </div>
                            {{--                        @endif--}}

                            @if(Auth::user()->department == "Administrator"|| Auth::user()->department == "MICT")
                                <div id="dsystem" class="col-lg-4 col-md-4" hidden>
                                    <label><br>System Category</label>
                                    <select id="system"
                                            class="form-control select2bs4 @error("sys_category")is-invalid @enderror"
                                            id="syscategory"
                                            name="sys_category"
                                            style="width: 100%;"
                                            disabled>
                                        {{--                                    <option></option>--}}
                                        <option value="Bizbox" {{ old('sys_category') == 'Bizbox' ? 'selected':''}}>Bizbox</option>
                                        <option value="PACS" {{ old('sys_category') == 'PACS' ? 'selected':''}}>PACS</option>
                                        <option value="LIS - SYSMEX" {{ old('sys_category') == 'LIS - SYSMEX' ? 'selected':''}}>LIS - SYSMEX</option>
                                        <option value="LIS - MARSMAN" {{ old('sys_category') == 'LIS' ? 'selected':''}}>LIS - MARSMAN</option>
                                        <option value="LIS - J&J" {{ old('sys_category') == 'LIS - J&J' ? 'selected':''}}>LIS - J&J</option>
                                        <option value="DMS" {{ old('sys_category') == 'DMS' ? 'selected':''}}>DMS</option>
                                        <option value="ACC PAC" {{ old('sys_category') == 'ACC PAC' ? 'selected':''}}>ACC PAC</option>
                                        <option value="MEDEXPRESS" {{ old('sys_category') == 'MEDEXPRESS' ? 'selected':''}}>MEDEXPRESS</option>
                                        <option value="ACCESS DB" {{ old('sys_category') == 'ACCESS DB' ? 'selected':''}}>ACCESS DB</option>
                                        <option value="ASSET" {{ old('sys_category') == 'ASSET' ? 'selected':''}}>ASSET TRACER</option>
                                        <option value="CHEQUE TRACER" {{ old('sys_category') == 'CHEQUE TRACER' ? 'selected':''}}>CHEQUE TRACER</option>
                                        <option value="Others" {{ old('sys_category') == 'Others' ? 'selected':''}}>Others</option>
                                    </select>
                                </div>
                            @endif

                            @if(Auth::user()->department == 'MICT' || Auth::user()->department == 'Administrator')
                                <div class="col-lg-4 col-md-4">
                                    <label><br>Level of Priority</label>
                                    <select class="form-control select2bs4 @error("lop")is-invalid @enderror"
                                            value="{{old('lop')}}" id="lop" name="lop"
                                            style="width: 100%;">
                                        <option></option>
                                        <option value="Low" {{ old('lop') == 'Low' ? 'selected':''}}>Low</option>
                                        <option value="Medium" {{ old('lop') == 'Medium' ? 'selected':''}}>Medium</option>
                                        <option value="High" {{ old('lop') == 'High' ? 'selected':''}}>High</option>
                                    </select>
                                </div>
                            @endif

                            <div class="col-lg-12 col-md-12">
                                <label> <br>
                                    Issue / Concerns
                                </label>
                                <textarea name="concerns"
                                          placeholder="Place some text here"
                                          class="@error("concerns")is-invalid @enderror"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('concerns')}}</textarea>
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
                                    <textarea id="act" class="textarea" placeholder="Place some text here"
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
        $('#act').summernote({
            height: 300,
            placeholder: 'Write here...',
        });

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
                $("#dogst1").prop("disabled", false);
                $("#dogst1").prop("hidden", false);
                $("#dogst2").prop("disabled", false);
                $("#dogst2").prop("hidden", false);
            } else {
                $("#ogs").prop("disabled", true);
                $("#dogs").prop("hidden", true);
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
    <script>
        window.onload = function exampleFunction() {
            // Function to executed
            if ($('#status').val() == "On-Going") {
                $("#ogs").prop("disabled", false);
                $("#dogs").prop("hidden", false);
                $("#dogst1").prop("disabled", false);
                $("#dogst1").prop("hidden", false);
                $("#dogst2").prop("disabled", false);
                $("#dogst2").prop("hidden", false);
            } else {
                $("#ogs").prop("disabled", true);
                $("#dogs").prop("hidden", true);
                $("#dogst1").prop("disabled", true);
                $("#dogst1").prop("hidden", true);
                $("#dogst2").prop("disabled", true);
                $("#dogst2").prop("hidden", true);
            }
            if ($('#category').val() == "System") {
                $("#system").prop("disabled", false);
                $("#dsystem").prop("hidden", false);
            } else {
                $("#system").prop("disabled", true);
                $("#dsystem").prop("hidden", true);
            }
            if ($('#category').val() == "Others") {
                $("#other").prop("disabled", false);
                $("#dother").prop("hidden", false);
            } else {
                $("#other").prop("disabled", true);
                $("#dother").prop("hidden", true);
            }
            if ($('#status').val() == "Closed") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else if ($('#status').val() == "Resolve") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else {
                $("#act").prop("disabled", true);
                $("#dact").prop("hidden", true);
            }
        }
    </script>

@endsection


@section('footer',"<p></p>")
