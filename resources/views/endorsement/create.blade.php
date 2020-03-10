@extends('layouts.master')

@section('title', 'Create Endorsement | ')
@include('layouts.scripts')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            Create an Endorsement
                        </h1>
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
        </section>

        <form action="/Endorsement" enctype="multipart/form-data" method="post">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Compose New Message</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="to">To</label>
{{--                                            <input name="to" id="to" class="form-control"--}}
{{--                                                   placeholder="Names to be delivered to">--}}
                                            <select class="form-control select2bs4"
                                                    name="assigned_to[]"
                                                    data-placeholder="Assigned to..."
                                                    multiple="multiple" style="width: 100%;" id="to">
                                                <option></option>
                                                @foreach($users as $user)
                                                    <option
                                                        value="{{$user->id}}">{{$user->fname." ".$user->lname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="department">Departments</label>
                                            <select class="form-control select2bs4"
                                                    name="departments[]"
                                                    data-placeholder="Assigned to departments"
                                                    multiple="multiple" style="width: 100%;" id="department">
                                                <option></option>
                                                @foreach($departments as $department)
                                                    <option
                                                        value="{{$department->id}}">{{$department->dept_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="ticket">Ticket no.</label>
                                            <select class="form-control select2bs4"
                                                    name="ticket[]"
                                                    data-placeholder="Ticket No."
                                                    multiple="multiple" style="width: 100%;" id="ticket">
                                                <option></option>
                                                @foreach($tickets as $ticket)
                                                    <option
                                                        value="{{$ticket->id}}">{{str_pad($ticket->id,5,'0',STR_PAD_LEFT)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="title">Title</label>
                                            <input name="title" id="title" class="form-control"
                                                   placeholder="Title of your endorsement">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="compose-textarea"></label>
                                        <textarea id="compose-textarea" name="body" class="form-control" style="height: 300px">

                                        </textarea>
                                    </div>
                                    <div class="form-group">
{{--                                        <div class="btn btn-default btn-file">--}}
{{--                                            <i class="fas fa-paperclip"></i> Attachment--}}

{{--                                        </div>--}}
{{--                                        <p class="help-block">Max. 32MB</p>--}}
                                        @csrf
                                        <input type="file" name="attachment[]" multiple>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i>
                                            Send
                                        </button>
                                    </div>
                                    <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard
                                    </button>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </form>
    </div>


    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $(function () {
            //Add text editor
            $('#compose-textarea').summernote({
                height: 300,
                placeholder: "Write here...",
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            })
        })
    </script>
@endsection


{{--@section('footer',"<p></p>")--}}
