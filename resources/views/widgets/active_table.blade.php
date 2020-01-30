<table class="table">
    <thead>
    <tr>
        <th>Ticket#</th>
        <th>Department</th>
        <th>Concerns</th>
        <th>Actions</th>
    </tr>
    </thead>
    @foreach($tickets as $ticket)
        <tbody>
        <tr>
            <td>{{$ticket->id}}</td>
            <td>{{$ticket->request_by}}</td>
            <td>{{\Illuminate\Support\Str::limit($ticket->concerns, 50, $end='...')}}</td>
            <td>
            </td>
        </tr>
        </tbody>
    @endforeach
</table>
