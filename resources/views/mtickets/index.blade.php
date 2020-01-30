@extends('layouts.master')

@section('title', 'MICT Tickets | ')
@include('layouts.scripts')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="col-12">
                <table id="department1"
                       class="wrap compact table table-responsive-sm table-hover table-borderedless table-striped ">
                    <thead>
                    <tr>
                        <th hidden>Sample Text</th>
                        <th width="6%">Ticket&nbsp;#</th>
                        <th width="10%">Reported&nbsp;by</th>
                        <th width="10%">Department</th>
                        <th width="10%">Status</th>
                        <th width="10%">Category</th>
                        <th width="30%">Issue&nbsp;/&nbsp;Concerns</th>
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
                            <tr class="table-dark">
                                @endif
                                <td hidden>{{$ticket->is_new}}</td>
                                <td>{{$ticket->id}}</td>
                                <td>{{$ticket->reported_by}}</td>
                                <td>{{$ticket->request_by}}</td>

                                @if($ticket->status == 'Active')
                                    <td style="text-align: center">
                                        @if($ticket->is_new = 1) <span class="badge badge-danger col-md-12">New</span>@endif
                                        <span class="badge badge-primary col-md-12">Active</span></td>
                                @elseif($ticket->status == 'On-Going')
                                    <td style="text-align: center"><span
                                            class="badge badge-warning   col-md-12">On-Going</span></td>
                                @elseif($ticket->status == 'Resolve')
                                    <td style="text-align: center"><span
                                            class="badge badge-success col-md-12">Resolve</span></td>
                                @elseif($ticket->status == 'Duplicate')
                                    <td style="text-align: center"><span
                                            class="badge badge-primary col-md-12">Duplicate</span></td>
                                @elseif($ticket->status == 'Closed')
                                    <td style="text-align: center"><span
                                            class="badge badge-danger col-md-12">Closed</span></td>
                                @endif
                                <td>{{$ticket->category}}</td>
                                <td>{{ \Illuminate\Support\Str::limit($ticket->concerns, 150, $end='...') }}</td>

                                <td>
                                    <div class="row">
                                        <a style="margin: 2px"
                                           class="btn btn-sm btn-outline-primary"
                                           href="/MICT-Tickets/{{$ticket->id}}"
                                        ><i class="fal fa-eye"></i></a>

                                        <a style="margin: 2px"
                                           class="btn btn-sm btn-outline-primary"
                                           href="/MICT-Tickets/{{$ticket->id}}/edit"
                                        ><i class="fal fa-pencil-alt"></i></a>
                                    </div>
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
        </section>
    </div>
    <script>
        $("#department1").DataTable({
            "order": [[0, "desc"]]
        });
    </script>

@endsection
