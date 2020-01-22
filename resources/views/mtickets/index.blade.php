@extends('layouts.master')

@section('title', 'Create New Tickets | ')
@include('layouts.scripts')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="col-12">
                <table id="department1" class="nowrap compact table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Ticket no.</th>
                        <th>Reported by</th>
                        <th>Department</th>
                        <th>Category</th>
                        <th>Issue/Concerns</th>
                        <th>LOP</th>
                        <th>Action</th>
                    </tr>
                    </thead>
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
            "columns": [
                { "width": "1%" },
                null,
                null,
                null,
                null,
                null,
                null,

            ]
        });
    </script>

@endsection
