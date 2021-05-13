<div class="table-responsive-lg">
    <table id="department1" class="nowrap compact table table-bordered table-striped">
        <thead>
        <tr>
            <th width="5%">ID no.</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($users as $key => $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->fname}}</td>
                <td>{{$user->lname}}</td>
                <td>{{$user->department}}</td>
                <td class="">
                    @if($user->id == 1 )
                        <a style="margin: 2px"
                           class="col-lg-12 btn btn-sm btn-outline-primary float-lg-left"
                           href="/users/{{$user->id}}"
                        >Edit</a>
                    @else
                        <a style="margin: 2px"
                           class="col-lg-6 btn btn-sm btn-outline-primary float-lg-left"
                           href="/users/{{$user->id}}"
                        >Edit</a>
                        <form action="/users/{{$user->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button style="margin: 2px" type="submit" class="col-lg-6 btn btn-sm btn-outline-danger" onclick='return confirm("Sure Want Delete Username: {!! $user->username !!}?")'>
                                Delete
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
<script>
    $("#department1").DataTable();
</script>
