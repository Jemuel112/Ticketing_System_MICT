@extends('layouts.master')

@section('title', 'View Ticket | ')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <form action='' method="POST" id="myForm">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <section class="content-header">
                <div class="container-fluid">
                    @if(session('message'))
                        <div style="" class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Sent Endorsement</h1>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            @csrf
            @method('POST')
            <section class="content" onload="functionToBeExecuted">
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            &nbsp;
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                        {{--End Data--}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {{--                        <div class="row"></div>--}}
                        <table id="endorsment"
                               style="width: 100%"
                               class="wrap compact table table-responsive-sm table-hover table-borderedless table-striped ">
                            <thead>
                            <tr>
                                <td>Doc.#</td>
                                <td>From</td>
                                <td>Title</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($endorsements as $endorsement)
                                <tr onclick="window.location='/Endorsement/{{$endorsement->id}}';">
                                    <td>{{ str_pad($endorsement->id,3,'0',STR_PAD_LEFT) }}</td>
                                    @php
                                        $user = \App\User::find($endorsement->created_by_id)
                                    @endphp
                                    @if($user)
                                        <td>{{$user->fname." ".$user->lname." (".$user->department.")"}}</td>
                                    @else
                                        <td>'User Deleted'</td>
                                    @endif
                                    <td>{{ \Illuminate\Support\Str::limit($endorsement->title, 100, $end='...') }}</td>

                                    <td>
                                        <a style="margin: 2px"
                                           class="btn btn-sm btn-outline-primary"
                                           href="Endorsement/{{$endorsement->id}}"
                                        ><i class="fal fa-pencil-alt"></i> View</a>
                                        <a style="margin: 2px"
                                           class="btn btn-sm btn-outline-primary"
                                           href="Endorsement/{{$endorsement->id}}/edit"
                                        ><i class="fal fa-pencil-alt"></i> Edit</a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Sent Endorsement at the moment</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content -->
        <!-- /.content-wrapper -->

    </form>

@endsection

@section('p-script')
    <script>
        $("#endorsment").DataTable({
            'processing': true,
            "order": [[0, "desc"]]
        });
    </script>
@endsection

