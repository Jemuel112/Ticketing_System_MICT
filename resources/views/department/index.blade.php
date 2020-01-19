@extends('layouts.master')

@section('title', 'Departments | ')

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
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Departments</h3>
                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#AddModal">Add
                            Department
                        </button>
                    </div>
                    <div class="card-body">
                            @asyncWidget('departments')
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
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-right">Add Department</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.scripts')
@endsection
