@extends('layouts.master')

@section('title', 'Create New Tickets | ')
@include('layouts.scripts')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="col-12">
                <table id="department1" class="table table-md table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Reported by</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Issue/Concerns</th>
                        <th>LOP</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach($tickets as $ticket)
                        @if($ticket->status == 'Active')
                            <tr class="table-success">
                        @elseif($ticket->status == 'On-Going')
                            <tr class="table-warning">
                        @elseif($ticket->status == 'Resolve')
                            <tr class="table-info">
                        @elseif($ticket->status == 'Duplicate')
                            <tr class="table-active">
                        @else
                            <tr class="table-danger">
                                @endif
                                <td style="text-align: center">{{$ticket->id}}</td>
                                <td style="text-align: center">{{$ticket->reported_by}}</td>
                                <td style="text-align: center">{{$ticket->request_by}}</td>
                                <td style="text-align: center">{{$ticket->status}}</td>
                                <td style="text-align: center">{{$ticket->category}}</td>
                                <td width="50%">{{ \Illuminate\Support\Str::limit($ticket->concerns, 100, $end='...') }}</td>
                                @if($ticket->lop == 'High')
                                    <td class="bg-danger"></td>
                                @elseif($ticket->lop == 'Medium')
                                    <td class="bg-warning"></td>
                                @elseif($ticket->lop == 'Low')
                                    <td class="bg-success"></td>
                                @else
                                    <td class="bg-info"></td>
                                @endif
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
