@extends('layouts.master')

@section('title', 'MICT Tickets | ')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            @if($errors->count()>0)
                <div style="" class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}} <br>
                    @endforeach
                </div>
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h4>{{$title}}</h4>
                </div>
                <div class="card-body">
                    <form action="/Sort" class="container-fluid" autocomplete="off" method="GET">
                        @csrf
                        <div class="row float-right" style="width: 100%;">
                            <div class="col-sm-3 col-lg-3" style="width: 100%;">
                                <input type="text" class="form-control float-right" name="datefilter"
                                       placeholder="Date Range" value="{{request()->input('datefilter')}}">
                            </div>
                            @if(Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT')
                                <div class="col-sm-3 col-lg-3">
                                    <select class="form-control select2bs4 col-md-7" name="department" id="deps"
                                            style="width: 100%;">
                                        <option value=""></option>
                                        @foreach($departments as $dept)
                                            <option
                                                value="{{$dept->dept_name}}" {{ request()->input('department') == $dept->dept_name ? 'selected':''}}>{{$dept->dept_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-sm-3 col-lg-3">
                                <select class="form-control select2 col-md-7"
                                        name="status" id="stats"
                                        style="width: 100%;">
                                    <option value=""></option>
                                    <option value="Active" {{ request()->input('status') == 'Active' ? 'selected' :''}}>Active
                                    </option>
                                    <option value="On-Going" {{ request()->input('status') == 'On-Going' ? 'selected':''}}>
                                        On-Going
                                    </option>
                                    <option value="Resolve" {{ request()->input('status') == 'Resolve' ? 'selected':''}}>
                                        Resolve
                                    </option>
                                    <option value="Duplicate" {{ request()->input('status')== 'Duplicate' ? 'selected':''}}>
                                        Duplicate
                                    </option>
                                    <option value="Closed" {{ request()->input('status') == 'Closed' ? 'selected':''}}>Closed
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <button type="submit" class="btn btn-info col-12">Apply</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <div class="col-12" style="overflow-x:auto;">
                        <table id="department1"
                               style="width: 100%"
                               class="wrap compact table table-responsive-sm table-hover table-borderedless table-striped ">
                            <thead>
                            <tr>
                                <th hidden>Sample Text</th>
                                <th width="6%" style="text-align: center">Ticket&nbsp;#</th>
                                <th style="text-align: center">Reported&nbsp;by</th>
                                <th style="text-align: center">Department</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Category</th>

                                @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                    <th style="text-align: center">Created At</th>
                                @else
                                    <th width="30%">Issue / Concerns</th>
                                @endif

                                <th width="14%">Action</th>
                            </tr>
                            </thead>
                            @foreach($tickets as $ticket)
                                @if($ticket->lop == 'High')
                                    <tr class="table-danger">
                                @elseif($ticket->lop == 'Medium')
                                    <tr class="table-warning">
                                @elseif($ticket->lop == 'Low')
                                    <tr class="table-info">
                                @else
                                    <tr>
                                        @endif
                                        <td hidden>{{$ticket->is_new}}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ str_pad($ticket->id,5,'0',STR_PAD_LEFT) }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{$ticket->reported_by}}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{$ticket->request_by}}</td>
                                        @if($ticket->status == 'Active')
                                            <td style="text-align: center; vertical-align: middle;">
                                                @if($ticket->is_new == true)
                                                    <span style="margin-bottom: 2px;"
                                                          class="badge badge-danger col-sm-12">New</span>
                                                @endif
                                                <span class="badge badge-primary col-md-12">Active</span></td>
                                        @elseif($ticket->status == 'On-Going')
                                            <td style="text-align: center; vertical-align: middle;"><span
                                                    class="badge badge-warning   col-md-12">On-Going</span></td>
                                        @elseif($ticket->status == 'Resolve')
                                            <td style="text-align: center; vertical-align: middle;"><span
                                                    class="badge badge-success col-md-12">Resolve</span></td>
                                        @elseif($ticket->status == 'Duplicate')
                                            <td style="text-align: center; vertical-align: middle;"><span
                                                    class="badge badge-primary col-md-12">Duplicate</span></td>
                                        @elseif($ticket->status == 'Closed')
                                            <td style="text-align: center; vertical-align: middle;"><span
                                                    class="badge badge-danger col-md-12">Closed</span></td>
                                        @endif
                                        <td style="text-align: center; vertical-align: middle;">{{$ticket->category}}</td>
                                        @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                                            <td style="text-align: center; vertical-align: middle;">{{ date('F d, Y   h:i A', strtotime($ticket->created_at))}}</td>
                                        @else
                                            <td style="text-align: center; vertical-align: middle;">{{ \Illuminate\Support\Str::limit($ticket->concerns, 100, $end='...') }}</td>
                                        @endif
                                        <td>
                                            @if(Auth::user()->department == "MICT" || Auth::user()->department == "Administrator")
                                                <a style="margin: 2px"
                                                   class="btn btn-sm btn-outline-primary"
                                                   href="/MICT-Tickets/{{$ticket->id}}/edit"
                                                ><i class="fal fa-pencil-alt"></i> Edit</a>
                                            @else

                                                <a style="margin: 2px"
                                                   class="btn btn-sm btn-primary"
                                                   href="/MICT-Tickets/{{$ticket->id}}"
                                                ><i class="fal fa-eye"></i> View</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $("#department1").DataTable({
            'processing': true,
            "order": [[0, "desc"]]
        });

        //Date range picker
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

        // $('.select2').select2({
        //     theme: 'bootstrap4'
        // });
        // $('.select2bs4').select2({
        //     theme: 'bootstrap4'
        // });
        $selectElement = $('#deps').select2({
            theme: 'bootstrap4',
            placeholder: "Department",
            allowClear: true
        });
        $selectElement = $('#stats').select2({
            theme: 'bootstrap4',
            placeholder: "Status",
            allowClear: true
        });
    </script>

@endsection

@include('layouts.scripts')
