@extends('layouts.master')

@section('title', 'MICT Tickets | ')
@include('layouts.scripts')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="card card-info">
                <div class="card-header">
                    <h4>{{$title}}</h4>
                </div>
                <div class="card-body">
                    <div class="col-12">
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
                                    {{--        @foreach($users as $key => $user)--}}
                                    {{--            <tr>--}}
                                    {{--                <td>{{$user->id}}</td>--}}
                                    {{--                <td>{{$user->username}}</td>--}}
                                    {{--                <td>{{$user->fname}}</td>--}}
                                    {{--                <td>{{$user->lname}}</td>--}}
                                    {{--                <td>{{$user->department}}</td>--}}
                                    {{--                <td class="">--}}
                                    {{--                    @if($user->id == 1 )--}}
                                    {{--                        <a style="margin: 2px"--}}
                                    {{--                           class="col-lg-12 btn btn-sm btn-outline-primary float-lg-left"--}}
                                    {{--                           href="/users/{{$user->id}}"--}}
                                    {{--                        >Edit</a>--}}
                                    {{--                    @else--}}
                                    {{--                        <a style="margin: 2px"--}}
                                    {{--                           class="col-lg-6 btn btn-sm btn-outline-primary float-lg-left"--}}
                                    {{--                           href="/users/{{$user->id}}"--}}
                                    {{--                        >Edit</a>--}}
                                    {{--                        <form action="/users/{{$user->id}}" method="POST">--}}
                                    {{--                            @method('DELETE')--}}
                                    {{--                            @csrf--}}
                                    {{--                            <button style="margin: 2px" type="submit" class="  col-lg-6 btn btn-sm btn-outline-danger">Delete--}}
                                    {{--                            </button>--}}
                                    {{--                        </form>--}}
                                    {{--                    @endif--}}
                                    {{--                </td>--}}
                                    {{--            </tr>--}}
                                    {{--        @endforeach--}}
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $("#department1").DataTable({
            "order": [[0, "desc"]]
        });
    </script>

@endsection
