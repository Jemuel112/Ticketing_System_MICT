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

        <form action="/Endorsement" enctype="multipart/form-data" method="post" id="myForm">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Compose New Endorsement</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="to">Assigned To</label>
                                            {{--                                            <input name="to" id="to" class="form-control"--}}
                                            {{--                                                   placeholder="Names to be delivered to">--}}
                                            <select class="form-control select2bs4"
                                                    name="assigned_to[]"
                                                    data-placeholder="Assigned to..."
                                                    multiple="multiple" style="width: 100%;" id="to">
                                                <option></option>
                                                @php
                                                    $selected = explode(",", $endorsement->assigned_to_id)
                                                @endphp
                                                @foreach($users as $user)
                                                    <option
                                                        value="{{$user->id}}"  {{ (in_array($user->id, $selected)) ? 'selected' : '' }}>{{$user->fname." ".$user->lname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="department">Departments </label>
                                            <select class="form-control select2bs4"
                                                    name="departments[]"
                                                    data-placeholder="Assigned to departments"
                                                    multiple="multiple" style="width: 100%;" id="department">
                                                @php
                                                    $selected = explode(",", $endorsement->assigned_dept_id)
                                                @endphp
                                                <option value="All Department" {{(in_array("All Department", $selected)) ? 'selected' : '' }}>All Department</option>
                                                @foreach($departments as $department)
                                                    <option
                                                        value="{{$department->id}}" {{(in_array($department->id, $selected)) ? 'selected' : '' }}>{{$department->dept_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="ticket">Ticket no.</label>
                                            <select class="form-control select2bs4"
                                                    name="ticket[]"
                                                    data-placeholder="Ticket No."
                                                    multiple="multiple" style="width: 100%;" id="ticket">
                                                @php
                                                    $selected = explode(",", $endorsement->ticket_id)
                                                @endphp
                                                <option></option>
                                                @foreach($tickets as $ticket)
                                                    <option
                                                        value="{{$ticket->id}}" {{(in_array($ticket->id, $selected)) ? 'selected' : '' }}>{{str_pad($ticket->id,5,'0',STR_PAD_LEFT)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="title">Title</label>
                                            <input name="title" id="title" class="form-control"
                                                   placeholder="Title of your endorsement" value="{{$endorsement->title}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="compose-textarea"></label>
                                        <textarea id="compose-textarea" name="body" class="form-control" style="height: 300px">
                                            {{$endorsement->body ?? old('body')}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        @csrf
                                        <input type="file" name="attachment[]" multiple>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <h3>Files</h3>
                                        @forelse($files as $file)
                                            <a href="/Endorsement/{{$file->id}}/dl" target="_blank">{{$file->org_file_name}}</a><br>
                                            @empty
                                        @endforelse
                                    </div>
                                </div>
                                <!-- /.card-body -->
{{--                                <div class="card-footer">--}}
{{--                                    <div class="float-right">--}}

{{--                                    </div>--}}
{{--                                </div>--}}
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
@section('footer')
    <footer class="main-footer">
        <div class="float-right">
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>
                Update
            </button>

        </div>
        <strong>Copyright &copy; 2020 <a href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong> All
        rights
        reserved.
        <b>Version</b> 1.0.0
    </footer>
    @endsection

<script type="text/javascript">
        $(window).on("beforeunload", function () {
            return "Are you sure? You didn't finish the form!";
        });
        $(document).ready(function () {
            $("#myForm").on("submit", function (e) {
                //check form to make sure it is kosher
                //remove the ev
                $(window).off("beforeunload");
                return true;
            });
        });


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


