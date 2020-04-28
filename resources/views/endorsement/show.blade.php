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
                            {{--                            Read an Endorsement--}}
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
                    <h3 class="card-title"><b>Title:</b> {{$endorse->title}}</h3>
                    {{--                    <h2 class="card-header"></h2>--}}
                    {{--                    <div class="card-tools">--}}
                    {{--                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i--}}
                    {{--                                class="fas fa-chevron-left"></i></a>--}}
                    {{--                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i--}}
                    {{--                                class="fas fa-chevron-right"></i></a>--}}
                    {{--                    </div>--}}
                </div>
                <!-- /.card-header -->
                <div class="card-body p-2">
                    <div class="mailbox-read-info p-2">

                        <h6><b> From: </b> <a href="#">{{$user->fname." ".$user->lname." (".$user->department.")"}}</a>
                            <span
                                class="mailbox-read-time float-right">{{date('F d, Y   h:i A', strtotime($endorse->created_at))}}</span>
                        </h6>
                        @if($to)
                            <h6>To:
                                @foreach($to as $users)
                                    &nbsp;{{$users->fname." ".$users->lname." (".$users->department."), "}}
                                @endforeach
                            </h6>
                        @endif
                        @if($departments)
                            <h6>Departments:
                                @foreach($departments as $department)
                                    &nbsp;{{$department->dept_name.","}}
                                @endforeach
                            </h6>
                        @endif
                    </div>
                    <!-- /.mailbox-read-info -->

                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message p-5">
                        {!! $endorse->body !!}
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
                @if(count( $files) > 0)
                    <div class="card-footer bg-white p-5">
                        <h3>Attached files:</h3>
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                            @foreach($files as $file)
                                {{--                                @if($file->extension_name == "pdf")--}}
                                <li>
                                    <span class="mailbox-attachment-icon"><i class="far fa-file"></i></span>
                                    <div class="mailbox-attachment-info">
                                        <a href="{{route('Endorsement.dl',['id' => $file->id])}}"
                                           class="mailbox-attachment-name"><i
                                                class="fas fa-paperclip"></i> {{$file->org_file_name}}</a>
                                        <span class="mailbox-attachment-size clearfix mt-1">
{{--                          <span>1,245 KB</span>--}}
                                            {{--                          <a href="#" class="btn btn-default btn-sm float-right"><i--}}
                                            {{--                                  class="fas fa-cloud-download-alt"></i></a>--}}
                        </span>
                                    </div>
                                </li>
                            @endforeach
                            {{--                        <li>--}}
                            {{--                            <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>--}}
                            {{--                            <div class="mailbox-attachment-info">--}}
                            {{--                                <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i>--}}
                            {{--                                    Sep2014-report.pdf</a>--}}
                            {{--                                <span class="mailbox-attachment-size clearfix mt-1">--}}
                            {{--                                                <span>1,245 KB</span>--}}
                            {{--                                                <a href="#" class="btn btn-default btn-sm float-right"><i--}}
                            {{--                                                        class="fas fa-cloud-download-alt"></i></a>--}}
                            {{--                                            </span>--}}
                            {{--                            </div>--}}
                            {{--                        </li>--}}


                            {{--                        <li>--}}
                            {{--                            <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>--}}

                            {{--                            <div class="mailbox-attachment-info">--}}
                            {{--                                <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App--}}
                            {{--                                    Description.docx</a>--}}
                            {{--                                <span class="mailbox-attachment-size clearfix mt-1">--}}
                            {{--                          <span>1,245 KB</span>--}}
                            {{--                          <a href="#" class="btn btn-default btn-sm float-right"><i--}}
                            {{--                                  class="fas fa-cloud-download-alt"></i></a>--}}
                            {{--                        </span>--}}
                            {{--                            </div>--}}
                            {{--                        </li>--}}
                            {{--                        <li>--}}
                            {{--                            <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png"--}}
                            {{--                                                                               alt="Attachment"></span>--}}

                            {{--                            <div class="mailbox-attachment-info">--}}
                            {{--                                <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>--}}
                            {{--                                <span class="mailbox-attachment-size clearfix mt-1">--}}
                            {{--                          <span>2.67 MB</span>--}}
                            {{--                          <a href="#" class="btn btn-default btn-sm float-right"><i--}}
                            {{--                                  class="fas fa-cloud-download-alt"></i></a>--}}
                            {{--                        </span>--}}
                            {{--                            </div>--}}
                            {{--                        </li>--}}
                            {{--                        <li>--}}
                            {{--                            <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png"--}}
                            {{--                                                                               alt="Attachment"></span>--}}

                            {{--                            <div class="mailbox-attachment-info">--}}
                            {{--                                <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo2.png</a>--}}
                            {{--                                <span class="mailbox-attachment-size clearfix mt-1">--}}
                            {{--                          <span>1.9 MB</span>--}}
                            {{--                          <a href="#" class="btn btn-default btn-sm float-right"><i--}}
                            {{--                                  class="fas fa-cloud-download-alt"></i></a>--}}
                            {{--                        </span>--}}
                            {{--                            </div>--}}
                            {{--                        </li>--}}
                        </ul>
                    </div>
            @endif

            <!-- /.card-footer -->
                <div class="card-footer">
                    Seen by:@forelse($seens as $seen)
                        @php
                            $name = App\User::find($seen->seen_id);
                        @endphp
                        <a href="#">{{$name->fname}} {{$name->lname}} <span class="mailbox-read-time">({{date('F d, Y   h:i A', strtotime($seen->created_at))}})</span></a>
                    @empty
                    @endforelse
                </div>
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


@endsection


