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
                                    @if($user->id == 1)
                                        <option value="Administrator">Administrator</option>
                                    @else
                                        @foreach($departments as $department)
                                            <option
                                                value="{{$department->dept_name}}" {{$department->dept_name == $user->department  ? 'selected' : ''}}>{{$department->dept_name}}</option>
                                        @endforeach
                                    @endif

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
        </section>
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
        });
    </script>
@endsection
