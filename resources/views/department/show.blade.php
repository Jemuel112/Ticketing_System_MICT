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

            {{--            SHOW DEPARTMENTS ERRORS--}}
            @if($errors->count()>0)
                <div style="" class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}} <br>
                    @endforeach
                </div>
            @endif
            {{--            END SHOW DEPARTMENTS ERRORS--}}



            {{--            ADD FORM--}}
            <form action="/departments/{{$department->id}}" method="post">
                @method('PUT')
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit Department ({{$department->dept_name}})</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <label for="dept_name">Department Name</label>
                        <input class="form-control col-md-6" name="dept_name" type="text"
                               autocomplete="off" value="{{old('dept_name') ?? $department->dept_name}}">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                @csrf
            </form>
            {{--            END ADD FORM--}}

            {{--            SHOW DAPARTMENTS--}}
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Departments</h3>
                    <div class="card-tools">
                        <button class="btn btn-success " data-toggle="modal" data-target="#AddModal">Add
                            Department
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{--                    DEPARTMENT TABLE WIDGET--}}
                    @asyncWidget('departments')
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
                    <h5 class="modal-title" id="AddModal">Add Department</h5>
                </div>
                <div class="modal-body">
                    <form action="/departments" method="POST">
                        @csrf
                        <label for="dept_name">Department Name</label>
                        <input class="form-control" name="dept_name" type="text"
                               placeholder="Please input a valid department name"
                               autocomplete="off" value="{{old('dept_name')}}">
                        <hr>
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary float-right">Add Department</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--    END ADD MODAL--}}
    @include('layouts.scripts')

@endsection
