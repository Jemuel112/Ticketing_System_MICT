<div class="table-responsive">
    <table id="department1" class="nowrap compact table table-bordered table-striped">
        <thead>
        <tr>
            <th style="width: 45%">Department Name</th>
            <th style="width: 40%">Time Created</th>
            <th style="width: 25%">Actions</th>
        </tr>
        </thead>
        @foreach($departments as $key => $department)
            <tr>
                <td>{{$department->dept_name}}</td>
                <td>
                    {{$department->created_at->format('(D) M-d-Y h:i:s a')}}
                </td>
                <td>
                    <a style="margin: 2px"
                       class="col-lg-6 btn btn-sm btn-outline-primary float-lg-left"
                       href="/departments/{{$department->id}}"
                    >Edit</a>
                    <form action="/departments/{{$department->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button style="margin: 2px" type="submit" class="col-lg-6 btn btn-sm btn-outline-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
<script>
    $("#department1").DataTable();
</script>
