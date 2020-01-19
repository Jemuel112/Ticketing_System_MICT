@extends('layouts.master')

@section('title', 'Edit Department | ')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
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


            <form action="/users/{{$user->id}}" method="post">
                @method('PUT')
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit User ({{$user->username}})</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="username">Username</label>
                                <input id="username" class="form-control col-md-12" name="username" type="text"
                                       autocomplete="off" value="{{old('username') ?? $user->username}}">
                            </div>
                            <div class="col-md-6">
                                <label for="fname">First Name</label>
                                <input id="fname" class="form-control" name="fname" type="text"
                                       autocomplete="off" value="{{old('fname') ?? $user->fname}}">
                            </div>
                            <div class="col-md-6">
                                <label for="lname">Last Name</label>
                                <input id="lname" class="form-control" name="lname" type="text"
                                       autocomplete="off" value="{{old('lname') ?? $user->lname}}">
                            </div>
                            <div class="col-md-12">
                                <label for="department">Department</label>
                                <select name="department"
                                        class="select2bs4 form-control  @error('Department') is-invalid @enderror"
                                        required>
                                    @if(Auth::user()->id == 1)
                                        <option value="Administrator">Administrator</option>
                                    @endif
                                    @foreach($departments as $department)
                                        <option
                                            value="{{$department->dept_name}}" {{$department->dept_name == $user->department  ? 'selected' : ''}}>{{$department->dept_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       autocomplete="new-password">
                            </div>
                            <div class="col-md-6">
                                <label for="password">Confirm Psassword</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                @csrf
            </form>

            {{--            SHOW DAPARTMENTS--}}
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Departments</h3>
                    <div class="card-tools">
                        <button class="btn btn-success " data-toggle="modal" data-target="#AddModal">Add
                            User
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{--                    DEPARTMENT TABLE WIDGET--}}
                    @asyncWidget('users')
                </div>
                <!-- /.card-body -->
            </div>
            {{--            END SHOW DEPARTMENTS--}}
        </section>
    </div>





    {{--ADD MODAL--}}
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true"
         data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Add User</h5>
                </div>
                <div class="modal-body">
                    <form action="/users" method="POST" autocomplete="off">
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
                        <button type="submit" class="btn btn-primary float-right">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--    END ADD MODAL--}}
    @include('layouts.scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endsection
