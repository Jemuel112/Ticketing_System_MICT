<table class="table table-hover" style="width: 100%;">
    <thead>
    <tr>
        <th>Department</th>
        <th>Count</th>
        <th>Actions</th>
    </tr>
    </thead>
    @forelse($tickets as $ticket => $inner)
        <tbody>
        <tr>
            <td>{{$ticket}}</td>
            <td>{{$inner->count()}}</td>
            <td>
                <form action=""></form>
                <a style="margin: 2px"
                   class="btn btn-sm btn-primary"
                   href="/MICT-Tickets"><i class="fal fa-eye"></i> View</a>
                {{--                @if(Auth::user()->department == "MICT" || Auth::user()->department == "Administrator")--}}
                {{--                    <a style="margin: 2px"--}}
                {{--                       class="btn btn-sm btn-outline-primary"--}}
                {{--                       href="/MICT-Tickets/{{$ticket->id}}/edit"--}}
                {{--                    ><i class="fal fa-pencil-alt"></i> Edit</a>--}}
                {{--                @else--}}
                {{--                    <a style="margin: 2px"--}}
                {{--                       class="btn btn-sm btn-primary"--}}
                {{--                       href="/MICT-Tickets/{{$ticket->id}}"--}}
                {{--                    ><i class="fal fa-eye"></i> View</a>--}}
                {{--                @endif--}}
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center">No Active Tickets</td>
            </tr>
        </tbody>
    @endforelse
</table>

{{--<table class="table table-hover" style="width: 100%;">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th width="20%">Ticket#</th>--}}
{{--        <th width="20%">Department</th>--}}
{{--        <th width="40%">Concerns</th>--}}
{{--        <th width="20%">Actions</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    @forelse($tickets as $ticket)--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td>{{$ticket->id}}</td>--}}
{{--            <td>{{$ticket->request_by}}</td>--}}
{{--            <td>{{\Illuminate\Support\Str::limit($ticket->concerns, 50, $end='...')}}</td>--}}
{{--            <td>--}}
{{--                @if(Auth::user()->department == "MICT" || Auth::user()->department == "Administrator")--}}
{{--                    <a style="margin: 2px"--}}
{{--                       class="btn btn-sm btn-outline-primary"--}}
{{--                       href="/MICT-Tickets/{{$ticket->id}}/edit"--}}
{{--                    ><i class="fal fa-pencil-alt"></i> Edit</a>--}}
{{--                @else--}}

{{--                    <a style="margin: 2px"--}}
{{--                       class="btn btn-sm btn-primary"--}}
{{--                       href="/MICT-Tickets/{{$ticket->id}}"--}}
{{--                    ><i class="fal fa-eye"></i> View</a>--}}
{{--                @endif--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        @empty--}}
{{--            <tr>--}}
{{--                <td colspan="4" style="text-align: center">No Active Tickets</td>--}}
{{--            </tr>--}}
{{--        </tbody>--}}
{{--    @endforelse--}}
{{--</table>--}}


