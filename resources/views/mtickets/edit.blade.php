@extends('layouts.master')

@section('title', 'View Ticket | ')
@include('layouts.scripts')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ticket # {{str_pad($ticket->id,5,'0',STR_PAD_LEFT)}}</h1>
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


        <section class="content" onload="functionToBeExecuted">
            <form action='/MICT-Tickets/{{$ticket->id}}' method="POST" id="myForm">
                @csrf
                @method('PUT')
                @if(Auth::user()->department == 'Administrator')
                    <div class="card card-cyan">
                        <div class="card-header">
                            <h3 class="card-title">Date</h3>
                            <div class="card-tools">
                                &nbsp;
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Create At</label>
                                    <div class="form-group">
                                        <div class="input-group date"
                                             data-target-input="nearest">
                                            <input type="text" name="created_at" id="datetimepicker7"
                                                   class="form-control datetimepicker-input"
                                                   data-target="#datetimepicker7"
                                                   value="{{date('m/d/Y h:i A', strtotime($ticket->created_at))}}">
                                            <div class="input-group-append" data-target="#datetimepicker7"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label>Finished At</label>
                                    <div class="form-group">
                                        <div class="input-group date"
                                             data-target-input="nearest">
                                            <input type="text" name="finished_at" id="datetimepicker8"
                                                   class="form-control datetimepicker-input"
                                                   data-target="#datetimepicker8"
                                                   @if(!is_null($ticket->finished_at))
                                                   value="{{date('m/d/Y h:i A', strtotime($ticket->finished_at))}}"
                                                @endif>
                                            <div class="input-group-append" data-target="#datetimepicker8"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
                                <label @error('reported_by') class="text-red" @enderror>Reported by</label>
                                @error('reported_by')
                                <span class="text-red">is required</span>
                                @enderror
                                <input class="form-control @error("reported_by")is-invalid @enderror"
                                       value="{{$ticket->reported_by ?? old('reported_by')}}"
                                       style="width: 100%;" type="text" name="reported_by" placeholder="Name"
                                >
                            </div>
                            {{--End Reported by--}}


                            {{--Request by--}}
                            <div class="col-lg-3 col-sm-3">
                                <label for="reqb" @error('request_by') class="text-red" @enderror>Request By</label>
                                @error('request_by')
                                <span class="text-red">is required</span>
                                @enderror
                                @if(Auth::user()->department == 'Administrator' || Auth::user()->department == "MICT")
                                    <select class="form-control select2bs4 @error("request_by")is-invalid @enderror"
                                            id="reqb" name="request_by"
                                            style="width: 100%;">
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                            <option
                                                value="{{$department->dept_name}}" {{ $ticket->request_by == ($department->dept_name ??  old('request_by')) ? 'selected':''}}>{{$department->dept_name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control select2bs4 @error("request_by")is-invalid @enderror"
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
                                <label for="reqb" @error('request_by') class="text-red" @enderror>Status</label>
                                @error('request_by')
                                <span class="text-red">is required</span>
                                @enderror
                                <select class="form-control select2bs4 @error("status")is-invalid @enderror"
                                        name="status"
                                        style="width: 100%;"
                                        id="status">
                                    {{--                                        {{$ticket->status == $user->department  ? 'selected' : ''}}--}}
                                    <option
                                        value="Active" {{ (old('status') ?? $ticket->status) == 'Active' ? 'selected' :''}}>
                                        Active
                                    </option>
                                    <option
                                        value="On-Going" {{ (old('status') ?? $ticket->status) == 'On-Going' ? 'selected':''}}>
                                        On-Going
                                    </option>
                                    <option
                                        value="Resolve" {{ (old('status') ?? $ticket->status) == 'Resolve' ? 'selected':''}}>
                                        Resolve
                                    </option>
                                    <option
                                        value="Duplicate" {{  (old('status') ?? $ticket->status) == 'Duplicate' ? 'selected':''}}>
                                        Duplicate
                                    </option>
                                    <option
                                        value="Closed" {{  (old('status') ?? $ticket->status) == 'Closed' ? 'selected':''}}>
                                        Closed
                                    </option>
                                </select>
                            </div>
                            {{--End Status--}}

                            {{--On-Going Status--}}
                            <div class="col-lg-3 col-sm-3">
                                <div id="dogs" hidden>
                                    <label for="ogs" @error('og_status') class="text-red" @enderror>On-Going
                                        Status</label>
                                    @error('og_status')
                                    <span class="text-red">is required</span>
                                    @enderror
                                    <select class="form-control select2bs4 @error("og_status")is-invalid @enderror"
                                            name="og_status"
                                            id="ogs"
                                            style="width: 100%;">
                                        <option></option>
                                        <option
                                            value="Pending For Spare" {{ ($ticket->og_status ?? old('og_status'))== 'Pending For Spare' ? 'selected':''}}>
                                            Pending For Spare
                                        </option>
                                        <option
                                            value="Under Observation" {{ ($ticket->og_status ?? old('og_status')) == 'Under Observation' ? 'selected':''}}>
                                            Under Observation
                                        </option>
                                        <option
                                            value="Others" {{  ($ticket->og_status ?? old('og_status')) == 'Others' ? 'selected':''}}>
                                            Others
                                        </option>
                                    </select>
                                </div>
                            </div>
                            {{--End On-Going Status--}}


                            <div class="col-md-6" id="dogst1" hidden>
                                <label for="ogst" @error('start_at') class="text-red" @enderror><br>Select Date to start</label>
                                @error('start_at')
                                <span class="text-red">is required</span>
                                @enderror
                                <div class="input-group date" id="datetimepickers" data-target-input="nearest">
                                    <input type="text"
                                           class="form-control datetimepicker-input @error("start_at")is-invalid @enderror"
                                           @if(!is_null($ticket->start_at))
                                           value="{{date('m/d/Y h:i', strtotime($ticket->start_at)) ?? old('start_at')}}"
                                           @endif
                                           name="start_at"
                                           data-target="#datetimepickers">
                                    <div class="input-group-append" data-target="#datetimepickers"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="dogst2" hidden>
                                <label for="ogst" @error('end_at') class="text-red" @enderror><br>Select
                                    Deadline</label>
                                @error('end_at')
                                <span class="text-red">is required</span>
                                @enderror
                                <div class="input-group date" id="datetimepickerd" data-target-input="nearest">
                                    <input type="text"
                                           class="form-control datetimepicker-input @error("end_at")is-invalid @enderror"
                                           @if(!is_null($ticket->end_at))
                                           value="{{date('m/d/Y h:i', strtotime($ticket->end_at)) ?? old('end_at')}}"
                                           @endif
                                           name="end_at"
                                           data-target="#datetimepickerd"/>
                                    <div class="input-group-append" data-target="#datetimepickerd"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            {{--Acknoledge--}}
                            <div class="col-lg-3 col-md-3">
                                <label for="ackn" @error('acknowledge_by') class="text-red" @enderror><br>Acknowledge by</label>
                                @error('acknowledge_by')
                                <span class="text-red">is required</span>
                                @enderror
                                <select class="form-control select2bs4 @error("acknowledge_by")is-invalid @enderror"
                                        id="ackn" name="acknowledge_by"
                                        style="width: 100%;"
                                        @if(Auth::user()->department != "Administrator" || !is_null($ticket->acknowledge_by))
                                        disabled
                                    @endif>
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}" {{ ($ticket->acknowledge_by ?? old('acknowledge_by')) == $mict->fname ? 'selected':''}}>{{$mict->fname}}</option>
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
                                        name="assigned_to[]"
                                        data-placeholder="Assigned to..."
                                        multiple="multiple" style="width: 100%;">
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}" {{ in_array($mict->fname, $selected) ? 'selected' : '' }}>{{$mict->fname}}</option>
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
                                        name="assisted_by[]"
                                        data-placeholder="Assisted by..."
                                        multiple="multiple" style="width: 100%;">
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
                                        name="accomplished_by[]"
                                        data-placeholder="Accomplished by..."
                                        multiple="multiple" style="width: 100%;">
                                    <option></option>
                                    @foreach($micts as $mict)
                                        <option
                                            value="{{$mict->fname}}" {{ (in_array($mict->fname, $selected)) ? 'selected' : '' }}>{{$mict->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- End Accompleshed--}}

                            <div class="col-lg-4 col-md-4">
                                <label @error('category') class="text-red" @enderror><br>Category</label>
                                @error('category')
                                <span class="text-red">is required</span>
                                @enderror
                                <select class="form-control select2bs4 @error("category")is-invalid @enderror"
                                        id="category" name="category"
                                        style="width: 100%;">
                                    <option></option>
                                    <option value="System" {{ $ticket->category ?? old('category') == 'System' ? 'selected':''}}>System
                                    </option>
                                    <option value="Software" {{ $ticket->category ?? old('category') == 'Software' ? 'selected':''}}>
                                        Software
                                    </option>
                                    <option value="Hardware" {{ $ticket->category ?? old('category') == 'Hardware' ? 'selected':''}}>
                                        Hardware
                                    </option>
                                    <option value="Network" {{ $ticket->category ?? old('category') == 'Network' ? 'selected':''}}>Network
                                    </option>
                                    <option value="Others" {{ $ticket->category ?? old('category') == 'Others' ? 'selected':''}}>Others
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
                                <label @error('sys_category') class="text-red" @enderror><br>System Category</label>
                                @error('sys_category')
                                <span class="text-red">is required</span>
                                @enderror
                                <select id="system"
                                        class="form-control select2bs4 @error("sys_category")is-invalid @enderror"
                                        name="sys_category"
                                        style="width: 100%;">
                                    <option></option>
                                    {{--                                    <option></option>--}}
                                    <option value="Bizbox" {{  $ticket->sys_category ?? old('sys_category') == 'Bizbox' ? 'selected':''}}>
                                        Bizbox
                                    </option>
                                    <option value="PACS" {{ $ticket->sys_category ?? old('sys_category')== 'PACS' ? 'selected':''}}>PACS
                                    </option>
                                    <option
                                        value="LIS - SYSMEX" {{ $ticket->sys_category ?? old('sys_category') == 'LIS - SYSMEX' ? 'selected':''}}>
                                        LIS - SYSMEX
                                    </option>
                                    <option value="LIS - MARSMAN" {{ $ticket->sys_category ?? old('sys_category') == 'LIS' ? 'selected':''}}>
                                        LIS - MARSMAN
                                    </option>
                                    <option
                                        value="LIS - J&J" {{ $ticket->sys_category ?? old('sys_category') == 'LIS - J&J' ? 'selected':''}}>
                                        LIS - J&J
                                    </option>
                                    <option value="DMS" {{ $ticket->sys_category ?? old('sys_category') == 'DMS' ? 'selected':''}}>DMS
                                    </option>
                                    <option value="ACC PAC" {{ $ticket->sys_category ?? old('sys_category') == 'ACC PAC' ? 'selected':''}}>
                                        ACC PAC
                                    </option>
                                    <option
                                        value="MEDEXPRESS" {{ $ticket->sys_category ?? old('sys_category') == 'MEDEXPRESS' ? 'selected':''}}>
                                        MEDEXPRESS
                                    </option>
                                    <option
                                        value="ACCESS DB" {{ $ticket->sys_category ?? old('sys_category') == 'ACCESS DB' ? 'selected':''}}>
                                        ACCESS DB
                                    </option>
                                    <option value="ASSET" {{ $ticket->sys_category ?? old('sys_category') == 'ASSET' ? 'selected':''}}>ASSET
                                        TRACER
                                    </option>
                                    <option
                                        value="CHEQUE TRACER" {{ $ticket->sys_category ?? old('sys_category') == 'CHEQUE TRACER' ? 'selected':''}}>
                                        CHEQUE TRACER
                                    </option>
                                    <option value="Others" {{ $ticket->sys_category ?? old('sys_category') == 'Others' ? 'selected':''}}>
                                        Others
                                    </option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <label @error('lop') class="text-red" @enderror><br>Level of Priority</label>
                                @error('lop')
                                <span class="text-red">is required</span>
                                @enderror
                                <select class="form-control select2bs4 @error("lop")is-invalid @enderror"
                                        value="{{old('lop')}}" id="lop" name="lop"
                                        style="width: 100%;">
                                    <option></option>
                                    <option value="Low" {{ $ticket->lop ?? old('lop') == 'Low' ? 'selected':''}}>Low</option>
                                    <option value="Medium" {{ $ticket->lop ?? old('lop') == 'Medium' ? 'selected':''}}>Medium</option>
                                    <option value="High" {{ $ticket->lop ?? old('lop') == 'High' ? 'selected':''}}>High</option>
                                </select>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <label @error('concerns') class="text-red" @enderror><br>Issue / Concerns</label>
                                @error('concerns')
                                <span class="text-red">is required</span>
                                @enderror
                                <textarea name="concerns"
                                          placeholder=""
                                          style="resize: none ;width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('concerns') ?? $ticket->concerns }}</textarea>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <label><br>Additional Comments</label>
                                <textarea name="comment"
                                          placeholder="Enter your comments here"
                                          class="is-invalid"
                                          style="resize: none ;width: 100%; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                >{{old('comment')}}</textarea>
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
                                            <input type="checkbox" name="shared" value="{{old('shared')}}" id="checkboxDanger2">
                                            <label for="checkboxDanger2">Share info</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label></label>
                                        <textarea id="act" name="action" class="textarea"
                                                  placeholder="Place some text here"
                                                  style="width: 100%; height: 250px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('action')}}</textarea>
                                    </div>
                                @endif
                                <div class="col-lg-12 col-md-12">
                                    <label>Remarks / Recomendation</label>
                                    <textarea name="recommendation"
                                              placeholder="Enter Recommendation here"
                                              style="resize: none ;width: 100%; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('recommendation') ?? $ticket->recommendation}}</textarea>
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
                </div>
            </form>
        </section>

        @if($actions->count() >0)
            <section class="container-fluid">
                <form action="/MICT-Tickets/report" method="POST" id="myForm2">
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
                                    <div class="time-label">

                                            <span
                                                class="bg-gradient-indigo">{{date('M d, Y', strtotime($action))}}</span>
                                    </div>
                                @foreach($contents as $key => $content)
                                    @if($content->shared == 1 || Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT')

                                        <!-- /.timeline-label -->
                                            <!-- timeline item -->

                                            <div>
                                                <i class="fas fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <div class="icheck-danger float-right">
                                                        <input type="checkbox" name="action_id[]"
                                                               value="{{$content->id}}"
                                                               id="checkboxDanger[{{$content->id}}]">
                                                        <label for="checkboxDanger[{{$content->id}}]">Add to report
                                                            &nbsp;</label>
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
                                    <button type="submit" class="btn btn-info float-right">Generate Report</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>


                </form>
            </section>
        @endif
    </div>


    <footer class="main-footer">
        <div class="float-right">
            <button type="submit" class="btn btn-primary" form="myForm" onclick="mySubmit()">Submit</button>

        </div>
        <strong>Copyright &copy; 2020 <a href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong> All
        rights
        reserved.
        <b>Version</b> 1.0.0
    </footer>

    <!-- /.content -->
    <!-- /.content-wrapper -->

    <script type="text/javascript">
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
        $(window).on("beforeunload", function () {
            return "Are you sure? You didn't finish the form!";
        });
        $(document).ready(function () {
            $("#myForm2").on("submit", function (e) {
                //check form to make sure it is kosher
                //remove the ev
                $(window).off("beforeunload");
                return true;
            });
        });
    </script>

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
        {{--        {{date('m/d/Y h:i A', strtotime($ticket->created_at))}}--}}
        $("#datetimepicker7").datetimepicker({
            icons: {
                time: "far fa-clock"
            }
        });
        $("#datetimepicker8").datetimepicker({
            useCurrent: false,
            icons: {
                time: "far fa-clock"
            },
        });
        $("#datetimepicker7").on("change.datetimepicker", function (e) {
            $('#datetimepicker8').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker8").on("change.datetimepicker", function (e) {
            $('#datetimepicker7').datetimepicker('maxDate', e.date);
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
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
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
        });
        $('#category').change(function () {
            if ($('#category').val() == "System") {
                $("#dsystem").prop("hidden", false);
            } else {
                $("#dsystem").prop("hidden", true);
            }
        });

        // $('#category').change(function () {
        //     if ($('#category').val() == "Others") {
        //         $("#dother").prop("hidden", false);
        //     } else {
        //         $("#dother").prop("hidden", true);
        //     }
        // });

        $('#status').change(function () {
            if ($('#status').val() == "Closed") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else if ($('#status').val() == "Resolve") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else if ($('#status').val() == "On-Going") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else if ($('#status').val() == "On-Going") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else {
                $("#dact").prop("hidden", true);
                $("#act").prop("disabled", true);
            }
        });

        function mySubmit() {
            $("#ackn").prop("disabled", false);
        }
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
            } else if ($('#status').val() == "On-Going") {
                $("#act").prop("disabled", false);
                $("#dact").prop("hidden", false);
            } else {
                $("#dact").prop("hidden", true);
                $("#act").prop("disabled", true);
            }
        }

        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if (exist) {
            alert(msg);
        }
    </script>

@endsection


@section('footer',"<p></p>")
