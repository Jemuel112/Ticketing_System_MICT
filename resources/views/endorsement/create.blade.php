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
        </section>

        <form action="/Endorsement" enctype="multipart/form-data" method="post">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="mailbox.html" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Folders</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item active">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-inbox"></i> Inbox
                                                <span class="badge bg-primary float-right">12</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-envelope"></i> Sent
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-file-alt"></i> Drafts
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-filter"></i> Junk
                                                <span class="badge bg-warning float-right">65</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-trash-alt"></i> Trash
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Labels</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a href="/dl">Thing</a>
                                            <a href="{{ asset('favicon.ico')}}" target="_blank">Thing</a>
                                            <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i>
                                                Important</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i>
                                                Promotions</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i>
                                                Social</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Compose New Message</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="to">To</label>
                                            <input name="to" id="to" class="form-control"
                                                   placeholder="Names to be delivered to">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="department">Departments</label>
                                            <input id="department" name="department" class="form-control"
                                                   placeholder="Departments to be delivered to">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="title">Title</label>
                                            <input name="title" id="title" class="form-control"
                                                   placeholder="Title of your endorsement">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="compose-textarea"></label>
                                        <textarea id="compose-textarea" class="form-control" style="height: 300px">

                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="btn btn-default btn-file">
                                            <i class="fas fa-paperclip"></i> Attachment

                                        </div>
                                        <p class="help-block">Max. 32MB</p>
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
        $(function () {
            //Add text editor
            $('#compose-textarea').summernote({
                height: 300,
                placeholder: "Write here...",
            })
        })
    </script>
@endsection


@section('footer',"<p></p>")
