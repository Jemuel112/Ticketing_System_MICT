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
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Read Mail</h3>

                    <div class="card-tools">
                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="mailbox-read-info">
                        <h2>{{$endorse->title}}</h2>
                        <h6>From: {{$user->fname." ".$user->lname." (".$user->department.")"}}
                            <span class="mailbox-read-time float-right">15 Feb. 2015 11:03 PM</span></h6>
                        <h6>To:
                        @forelse($to as $to1)
                            @php
                                $to1 = \App\User::find($to1);
                            @endphp
                                &nbsp;{{$to1->fname." ".$to1->lname." (".$to1->department."), "}}
                            @empty
                            @endforelse
                        </h6>
                        <h6>Departments:
                            @foreach($departments as $department)
                                @php
                                    $department = \App\Department::find($department);
                                @endphp
                                &nbsp;{{$department->dept_name.","}}
                            @endforeach
                        </h6>
                    </div>
                    <!-- /.mailbox-read-info -->

                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        {!! $endorse->body !!}
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-white">
                    <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                        <li>
                            <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                            <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                                <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                            </div>
                        </li>
                        <li>
                            <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>

                            <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
                                <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                            </div>
                        </li>
                        <li>
                            <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>

                            <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                                <span class="mailbox-attachment-size clearfix mt-1">
                          <span>2.67 MB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                            </div>
                        </li>
                        <li>
                            <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>

                            <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo2.png</a>
                                <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1.9 MB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.card-footer -->
{{--                <div class="card-footer">--}}
{{--                    <div class="float-right">--}}
{{--                        <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>--}}
{{--                        <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>--}}
{{--                    </div>--}}
{{--                    <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>--}}
{{--                    <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>--}}
{{--                </div>--}}
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@section('footer')
    <p></p>
{{--    <footer class="main-footer">--}}
{{--        <div class="float-right">--}}
{{--            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>--}}
{{--                Update--}}
{{--            </button>--}}

{{--        </div>--}}
{{--        <strong>Copyright &copy; 2020 <a href="https://www.mcuhospital.org/">MCU Hospital</a>.</strong> All--}}
{{--        rights--}}
{{--        reserved.--}}
{{--        <b>Version</b> 1.0.0--}}
{{--    </footer>--}}
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


