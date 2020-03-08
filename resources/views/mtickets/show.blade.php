@extends('layouts.master')

@section('title', 'View Ticket | ')
@include('layouts.scripts')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <form action='/MICT-Tickets/comments/{{$ticket->id}}' method="POST" id="myForm">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Ticket # {{str_pad($ticket->id,5,'0',STR_PAD_LEFT)}}</h1>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            @csrf
            @method('POST')
            <section class="content" onload="functionToBeExecuted">
                @if(!is_null($ticket->acknowledge_by))
                    <div class="callout callout-info">
                        {{--                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
                        {{--                    <h5><i class="icon fas fa-exclamation-triangle"></i></h5>--}}
                        Editing of Ticket is disabled when an MICT Staff Acknowledge it.
                        <br>
                        If you want to edit your concerns just put it in the comment section.
                    </div>
                @endif
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Ticket Info</h3>

                        {{--Date--}}
                        <div class="card-tools">
                            &nbsp;
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
                                       value="{{$ticket->reported_by}}"
                                       style="width: 100%;" type="text" name="reported_by" placeholder="Name"
                                       id="report"
                                       @if($ticket->status != 'Active')
                                       disabled
                                    @endif
                                >
                            </div>
                            {{--End Reported by--}}


                            {{--Request by--}}
                            <div class="col-lg-3 col-sm-3">
                                <label for="reqb">Request By</label>
                                @if(Auth::user()->department == 'Administrator' || Auth::user()->department == "MICT")
                                    <select class="form-control select2bs4 @error("request_by")is-invalid @enderror"
                                            id="reqb" name="request_by"
                                            style="width: 100%;"
                                            disabled>
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                            <option
                                                value="{{$department->dept_name}}" {{ $ticket->request_by == $department->dept_name ? 'selected':''}}>{{$department->dept_name}}</option>
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
                                <select class="form-control select2bs4 @error("status")is-invalid @enderror"
                                        name="status"
                                        style="width: 100%;"
                                        id="status"
                                        disabled>
                                    {{--                                        {{$ticket->status == $user->department  ? 'selected' : ''}}--}}
                                    <option value="Active" {{ $ticket->status == 'Active' ? 'selected' :''}}>Active
                                    </option>
                                    <option value="On-Going" {{ $ticket->status == 'On-Going' ? 'selected':''}}>
                                        On-Going
                                    </option>
                                    <option value="Resolve" {{ $ticket->status == 'Resolve' ? 'selected':''}}>Resolve
                                    </option>
                                    <option value="Duplicate" {{ $ticket->status == 'Duplicate' ? 'selected':''}}>
                                        Duplicate
                                    </option>
                                    <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected':''}}>Closed
                                    </option>
                                </select>
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
                                        <option
                                            value="Pending For Spare" {{ $ticket->og_status == 'Pending For Spare' ? 'selected':''}}>
                                            Pending For Spare
                                        </option>
                                        <option
                                            value="Under Observation" {{ $ticket->og_status == 'Under Observation' ? 'selected':''}}>
                                            Under Observation
                                        </option>
                                        <option value="Others" {{ $ticket->og_status == 'Others' ? 'selected':''}}>
                                            Others
                                        </option>
                                    </select>
                                </div>
                            </div>
                            {{--End On-Going Status--}}


                            <div class="col-md-6" id="dogst1" hidden>
                                <label for="ogst"><br>Select Date to start</label>
                                <div class="input-group date" id="datetimepickers" data-target-input="nearest">
                                    <input type="text"
                                           class="form-control datetimepicker-input @error("start_at")is-invalid @enderror"
                                           value="{{date('m/d/Y h:i', strtotime($ticket->start_at))}}" name="start_at"
                                           data-target="#datetimepickers" disabled/>
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
                                           value="{{date('m/d/Y h:i', strtotime($ticket->end_at))}}" name="end_at"
                                           data-target="#datetimepickerd" disabled/>
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
                                        id="ackn" name="acknowledge_by[]"
                                        style="width: 100%;"
                                        disabled>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}" {{ $ticket->acknowledge_by == $mict->fname ? 'selected':''}}>{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- End Acknoledge--}}

                            {{--Assigned--}}
                            <div class="col-lg-3 col-md-3">
                                <label><br>Assigned to</label>
                                @php
                                    $selected = explode(",", $ticket->assigned_to)
                                @endphp
                                <select class="form-control select2bs4 @error("assigned_to")is-invalid @enderror"
                                        value="{{old('assigned_to')}}" name="assigned_to[]"
                                        data-placeholder="Assigned to..."
                                        multiple="multiple" style="width: 100%;"
                                        disabled>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}" {{ (in_array($mict->fname, $selected)) ? 'selected' : '' }}>{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--End Assigned--}}

                            {{--Assisted--}}
                            <div class="col-lg-3 col-md-3">
                                <label><br>Assisted By</label>
                                @php
                                    $selected = explode(",", $ticket->assisted_by)
                                @endphp
                                <select class="form-control select2bs4 @error("assisted_by")is-invalid @enderror"
                                        value="{{old('assisted_by')}}" name="assisted_by[]"
                                        data-placeholder="Assisted by..."
                                        multiple="multiple" style="width: 100%;"
                                        disabled>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}" {{ (in_array($mict->fname, $selected)) ? 'selected' : '' }}>{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--End Assisted--}}

                            {{--Accompleshed--}}
                            <div class="col-lg-3 col-md-3">
                                <label><br>Accomplished by</label>
                                @php
                                    $selected = explode(",", $ticket->accomplished_by)
                                @endphp
                                <select class="form-control select2bs4 @error("accomplished_by")is-invalid @enderror"
                                        value="{{old('accomplished_by')}}" name="accomplished_by[]"
                                        data-placeholder="Accomplished by..."
                                        multiple="multiple" style="width: 100%;"
                                        disabled>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}" {{ (in_array($mict->fname, $selected)) ? 'selected' : '' }}>{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- End Accompleshed--}}

                            <div class="col-lg-4 col-md-4">
                                <label><br>Category</label>
                                <select class="form-control select2bs4 @error("category")is-invalid @enderror"
                                        id="category" name="category"
                                        style="width: 100%;"
                                        disabled>
                                    <option></option>
                                    <option value="System" {{ $ticket->category == 'System' ? 'selected':''}}>System
                                    </option>
                                    <option value="Software" {{ $ticket->category == 'Software' ? 'selected':''}}>
                                        Software
                                    </option>
                                    <option value="Hardware" {{ $ticket->category == 'Hardware' ? 'selected':''}}>
                                        Hardware
                                    </option>
                                    <option value="Network" {{ $ticket->category == 'Network' ? 'selected':''}}>Network
                                    </option>
                                    <option value="Others" {{ $ticket->category == 'Others' ? 'selected':''}}>Others
                                    </option>
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

                            <div id="dsystem" class="col-lg-4 col-md-4" hidden>
                                <label><br>System Category</label>
                                <select id="system"
                                        class="form-control select2bs4 @error("sys_category")is-invalid @enderror"
                                        name="sys_category"
                                        style="width: 100%;"
                                        disabled>
                                    <option></option>
                                    {{--                                    <option></option>--}}
                                    <option value="Bixbox" {{  $ticket->sys_category == 'Bixbox' ? 'selected':''}}>
                                        Bixbox
                                    </option>
                                    <option value="PACS" {{ $ticket->sys_category == 'PACS' ? 'selected':''}}>PACS
                                    </option>
                                    <option
                                        value="LIS - SYSMEX" {{ $ticket->sys_category == 'LIS - SYSMEX' ? 'selected':''}}>
                                        LIS - SYSMEX
                                    </option>
                                    <option value="LIS - MARSMAN" {{ $ticket->sys_category == 'LIS' ? 'selected':''}}>
                                        LIS - MARSMAN
                                    </option>
                                    <option
                                        value="LIS - J&J" {{ $ticket->sys_category == 'LIS - J&J' ? 'selected':''}}>
                                        LIS - J&J
                                    </option>
                                    <option value="DMS" {{ $ticket->sys_category == 'DMS' ? 'selected':''}}>DMS
                                    </option>
                                    <option value="ACC PAC" {{ $ticket->sys_category == 'ACC PAC' ? 'selected':''}}>
                                        ACC PAC
                                    </option>
                                    <option
                                        value="MEDEXPRESS" {{ $ticket->sys_category == 'MEDEXPRESS' ? 'selected':''}}>
                                        MEDEXPRESS
                                    </option>
                                    <option
                                        value="ACCESS DB" {{ $ticket->sys_category == 'ACCESS DB' ? 'selected':''}}>
                                        ACCESS DB
                                    </option>
                                    <option value="ASSET" {{ $ticket->sys_category == 'ASSET' ? 'selected':''}}>ASSET
                                        TRACER
                                    </option>
                                    <option
                                        value="CHEQUE TRACER" {{ $ticket->sys_category == 'CHEQUE TRACER' ? 'selected':''}}>
                                        CHEQUE TRACER
                                    </option>
                                    <option value="Others" {{ $ticket->sys_category == 'Others' ? 'selected':''}}>
                                        Others
                                    </option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <label><br>Level of Priority</label>
                                <select class="form-control select2bs4 @error("lop")is-invalid @enderror"
                                        value="{{old('lop')}}" id="lop" name="lop"
                                        style="width: 100%;"
                                        disabled>
                                    <option></option>
                                    <option value="Low" {{ $ticket->lop == 'Low' ? 'selected':''}}>Low</option>
                                    <option value="Medium" {{ $ticket->lop == 'Medium' ? 'selected':''}}>Medium</option>
                                    <option value="High" {{ $ticket->lop == 'High' ? 'selected':''}}>High</option>
                                </select>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <label> <br>
                                    Issue / Concerns
                                </label>
                                <textarea name="concerns"
                                          placeholder="Place some text here"
                                          class="@error("concerns")is-invalid @enderror"
                                          style="resize: none ;width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          disabled>{{$ticket->concerns}}</textarea>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <label><br>Additional Comments</label>
                                <textarea name="comment"
                                          placeholder="Enter your comments here"
                                          class="is-invalid"
                                          style="resize: none ;width: 100%; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                ></textarea>
                                <br> &nbsp;
                            </div>

                            @forelse($comments as $comment)
                                <div class="col-md-12">
                                    <div class="post clearfix ">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="../../img/MCU.png"
                                                 alt="User Image">
                                            <span class="username"><a
                                                    href="#">{{app\User::findOrFail($comment->id_user)->fname}} {{app\User::findOrFail($comment->id_user)->lname}}</a></span>
                                            <span
                                                class="description float-right">{{date('M d, Y h:iA', strtotime($comment->created_at))}}</span>
                                            <span class="container container-fluid">{{$comment->comments}}</span>
                                        </div>

                                    </div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>
                    <!-- /.card-body -->
                    {{--                    <div class="card-footer">--}}
                    {{--                        Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples--}}
                    {{--                        and--}}
                    {{--                        information about--}}
                    {{--                        the plugin.--}}
                    {{--                    </div>--}}
                </div>
                <div id="dact" hidden>
                    <div class="card card-cyan">
                        <div class="card-header">
                            <h3 class="card-title">Actions Taken</h3>

                            <div class="card-tools">
                                &nbsp;
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                    <div class=" col-lg-12 container-fluid">
                                        <div class="icheck-danger float-right">
                                            <input type="checkbox" name="shared" id="checkboxDanger2">
                                            <label for="checkboxDanger2">Share info</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label></label>
                                        <textarea id="act" name="action" class="textarea"
                                                  placeholder="Place some text here"
                                                  style="width: 100%; height: 250px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                @endif
                                <div class="col-lg-12 col-md-12">
                                    <label>Remarks / Recomendation</label>
                                    <textarea name="recommendation"
                                              placeholder="Enter Recommendation here"
                                              style="resize: none ;width: 100%; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                              readonly>{{$ticket->recommendation}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        {{--                        <div class="card-footer">--}}
                        {{--                            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and--}}
                        {{--                            information about--}}
                        {{--                            the plugin.--}}
                        {{--                        </div>--}}
                    </div>
                    <br>
                </div>
            </section>

            @if($shared > 0)
                <section class="container-fluid">
                    <input type="text" name="ticket_id" value="{{$ticket->id}}" hidden>
                    @csrf
                    @method('POST')
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Actions Taken</h4>
                        </div>
                    </div>


                    <!-- Timelime example  -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <div class="timeline">
                                <!-- timeline time label -->
                                @forelse($actions as $action => $contents)
                                    @foreach($contents as $key => $content)
                                        @if($content->shared == 1 || Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT')
                                            <div class="time-label">

                                            <span
                                                class="bg-gradient-indigo">{{date('M d, Y', strtotime($action))}}</span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->

                                            <div>
                                                <i class="fas fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <div class="icheck-danger float-right">
                                                    </div>
                                                    <span class="time"><i class="fas fa-clock"></i> {{date(' h:i A', strtotime($content->created_at))}}</span>
                                                    <h3 class="timeline-header"><a
                                                            href="#">{{app\User::findOrFail($content->id_user)->fname}} {{app\User::findOrFail($content->id_user)->lname}}</a>
                                                    </h3>
                                                    <div class="timeline-body">
                                                        {{--                                                    echo strip_tags($content->actions)--}}
                                                        {!! $content->actions !!}
                                                    </div>
                                                    {{--                                        <div class="timeline-footer">--}}
                                                    {{--                                        </div>--}}
                                                </div>
                                            </div>
                                    @endif
                                @endforeach
                            @empty
                            @endforelse
                            <!-- END timeline item -->
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </section>
            @endif

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
    <script>
        $(window).on("beforeunload", function () {
            return "Are you sure? You didn't finish the form!";
        });
        $(document).ready(function () {
            $("#myForm").on("submit", function (e) {
                //check form to make sure it is kosher
                //remove the ev
                $(window).off("beforeunload");
                return true;
            });
        });
    </script>
    <script type="text/javascript">
        // $('#reqb').prop('disabled', true);
        // $('#report').prop('disabled', true);
        $("#datetimepickers").datetimepicker({
        });
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
        $selectElement = $('#system').select2({
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
                $("#dogs").prop("hidden", false);
                $("#dogst1").prop("disabled", false);
                $("#dogst1").prop("hidden", false);
                $("#dogst2").prop("disabled", false);
                $("#dogst2").prop("hidden", false);
            } else {
                $("#dogs").prop("hidden", true);
                $("#dogst1").prop("disabled", true);
                $("#dogst1").prop("hidden", true);
                $("#dogst2").prop("disabled", true);
                $("#dogst2").prop("hidden", true);
            }
        });
        $('#category').change(function () {
            if ($(this).val() == "System") {
                $("#dsystem").prop("hidden", false);
            } else {
                $("#dsystem").prop("hidden", true);
            }
        });
        $('#category').change(function () {
            if ($(this).val() == "Others") {
                $("#dother").prop("hidden", false);
            } else {
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
            }  else if($(this).val() == "On-Going") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            }else{
                $("#dact").prop("hidden", true);
                $("#act").prop("disabled", true);
            }
        });
    </script>
    <script>
        window.onload = function exampleFunction() {
            // Function to executed
            if ($('#status').val() == "On-Going") {
                $("#dogs").prop("hidden", false);
                $("#dogst1").prop("disabled", false);
                $("#dogst1").prop("hidden", false);
                $("#dogst2").prop("disabled", false);
                $("#dogst2").prop("hidden", false);
            } else {
                $("#dogs").prop("hidden", true);
                $("#dogst1").prop("disabled", true);
                $("#dogst1").prop("hidden", true);
                $("#dogst2").prop("disabled", true);
                $("#dogst2").prop("hidden", true);
            }
            if ($('#category').val() == "System") {
                $("#dsystem").prop("hidden", false);
            } else {
                $("#dsystem").prop("hidden", true);
            }
            if ($('#category').val() == "Others") {
                $("#dother").prop("hidden", false);
            } else {
                $("#dother").prop("hidden", true);
            }
            if ($('#status').val() == "Closed") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else if ($('#status').val() == "Resolve") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else if($(this).val() == "On-Going") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            }else{
                $("#dact").prop("hidden", true);
                $("#act").prop("disabled", true);
            }
        }
    </script>

@endsection


@section('footer',"<p></p>")
