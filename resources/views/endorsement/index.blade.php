@extends('layouts.master')

@section('title', 'Endorsements | ')
@include('layouts.scripts')

@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Endorsement</h1>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- Main content -->

            <section class="content row">
                <div class="col-sm-6">
                    <div class="card card-cyan ">
                        <div class="card-header">
                            <h3 class="card-title">Unread Endorsements</h3>
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
                            <table id="endorsements"
                                   style="width: 100%"
                                   class="wrap compact table table-responsive-sm table-hover table-borderedless table-striped ">
                                <thead>
                                <tr>
                                    <td width="10%">Doc.#</td>
                                    <td width="15%">From</td>
                                    <td>Title</td>
                                    <td width="15%">Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @if($unread == null)
                                    <tr>
                                        <td colspan="4" class="text-center">No Endorsement at the moment</td>
                                    </tr>
                                @else
                                    @foreach($unread as $endorsement)
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
                                            <td> {{ \Illuminate\Support\Str::limit($endorsement->title, 100, $end='...') }}</td>
                                            <td>
                                                <a style="margin: 2px"
                                                   class="btn btn-sm btn-outline-primary"
                                                   href="{{ route('Endorsement.show', ['id' => $endorsement->id]) }}"
                                                ><i class="fal fa-pencil-alt"></i> View</a>
                                                @if($endorsement->created_by_id == Auth::user()->id)
                                                    <a style="margin: 2px"
                                                       class="btn btn-sm btn-outline-primary"
                                                       href="{{ route('Endorsement.edit', ['id' => $endorsement->id]) }}"
                                                    ><i class="fal fa-pencil-alt"></i> Edit</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="card card-cyan">
                        <div class="card-header">
                            <h3 class="card-title">Read Endorsements</h3>
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
                            <table id="endorsements2"
                                   style="width: 100%"
                                   class="wrap compact table table-responsive-sm table-hover table-borderedless table-striped ">
                                <thead>
                                <tr>
                                    <td width="10%">Doc.#</td>
                                    <td width="15%">From</td>
                                    <td>Title</td>
                                    <td width="15%">Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @if($read == null)
                                    <tr>
                                        <td colspan="4" class="text-center">No Endorsement at the moment</td>
                                    </tr>
                                @else
                                    @foreach($read as $endorsement)
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
                                            <td> {{ \Illuminate\Support\Str::limit($endorsement->title, 100, $end='...') }}</td>

                                            <td>
                                                <a style="margin: 2px"
                                                   class="btn btn-sm btn-outline-primary"
                                                   href="{{ route('Endorsement.show', ['id' => $endorsement->id]) }}"
                                                ><i class="fal fa-pencil-alt"></i> View</a>
                                                @if($endorsement->created_by_id == Auth::user()->id)
                                                    <a style="margin: 2px"
                                                       class="btn btn-sm btn-outline-primary"
                                                       href="{{ route('Endorsement.edit', ['id' => $endorsement->id]) }}"
                                                    ><i class="fal fa-pencil-alt"></i> Edit</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        <!-- /.content -->
        <!-- /.content-wrapper -->

    <script>
        $("#endorsements").DataTable({
            'processing': true,
            "order": [[0, "desc"]]
        });
        $("#endorsements2").DataTable({
            'processing': true,
            "order": [[0, "desc"]]
        });
    </script>
@endsection


