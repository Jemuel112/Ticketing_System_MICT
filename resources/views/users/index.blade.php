@extends('layouts.master')

@section('title', 'Users | ')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
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
            @if(session('message'))
                <div style="" class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
            @if(session('message bad'))
                <div style="" class="alert alert-default-danger">
                    {{session('message bad')}}
                </div>
            @endif

            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#AddModal">Add
                            User
                        </button>
                    </div>
                    <div class="card-body">
                        @asyncWidget('users')

                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true"
         data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Add User</h5>
                </div>
                <div class="modal-body">
                    <form action="/users" method="POST" autocomplete="off" id="myForm">
                        @csrf
                        {{--Username--}}
                        <div class="row">
                            <label for="username">{{ __('Username') }}</label>

                            <input id="username" type="text"
                                   class="form-control @error('username') is-invalid @enderror" name="username"
                                   value="{{ old('username') }}" required autocomplete="off" autofocus>
                        </div>
                        {{--end Username--}}
                        {{--Firstname--}}
                        <div class="row">
                            <label for="fname">{{ __('First Name') }}</label>

                            <input id="fname" type="text"
                                   class="form-control @error('fname') is-invalid @enderror" name="fname"
                                   value="{{ old('fname') }}" required autocomplete="off">
                        </div>
                        {{--end Firstname--}}
                        {{--Lastname--}}
                        <div class="row">
                            <label for="lname">{{ __('Last Name') }}</label>

                            <input id="lname" type="text"
                                   class="form-control @error('lname') is-invalid @enderror" name="lname"
                                   value="{{ old('lname') }}" required autocomplete="off">
                        </div>
                        {{--end Lastname--}}

                        {{--department--}}
                        <div class="row">
                            <label for="department">{{ __('Department') }}</label>
                            <div class="col-lg-12">
                                <select name="department"
                                        class="form-control select2bs4 @error('Department') is-invalid @enderror"
                                        id="department" required>
                                    @if(Auth::user()->id == 1)
                                        <option value="Administrator">Administrator</option>
                                    @endif
                                    @foreach($departments as $department)
                                        <option value="{{$department->dept_name}}">{{$department->dept_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--End department--}}

                        {{--Password--}}
                        <div class="row">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="new-password">

                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                        {{--Password--}}

                        <hr>
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary float-right" id="btn-submit">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('p-script')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            $("#department1").DataTable();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#myForm").submit(function (e) {
                $("#btn-submit").attr("disabled", true);
                return true;
            });
        });
    </script>
@endsection
