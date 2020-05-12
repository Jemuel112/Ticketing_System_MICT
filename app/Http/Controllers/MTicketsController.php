<?php

namespace App\Http\Controllers;

use App\Department;
use App\mTicket;
use App\User;
use App\mcomments;
use App\mactions;
use Carbon\Carbon;
use DateTime;
use http\Env;
use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MTicketsController extends Controller
{
    public function __construct()
    {


        $this->middleware('disablepreventback');
        $this->middleware('auth');
        $this->middleware('auth.am')->except('index', 'store', 'create', 'show', 'comment','dashboard');
        $this->middleware('editvalid')->only('show');

//        $this->middleware('auth.admin')->only('index', 'store', 'allticket');
    }

    public function myTickets(Request $request)
    {
//        $request->headers->set('X-Authorization', env('PUSHER_APP_KEY'));

//        dd($request->header('X-Authorization'));
//        $request->header('API_KEY') = "sdasdasd";
        $name = Auth::user()->fname;
        $tickets = mTicket::where([['assigned_to', 'Like', '%' . "$name" . '%']]);
        $title = 'My Tickets';
        $departments = Department::all();

        if (!is_null($request->datefilter)) {
            $range = explode(' - ', $request->datefilter);
            if (DateTime::createFromFormat('m/d/Y', $range[0]) == FALSE) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['Start Date format is invalid'],
                ]);
                throw $error;
            }
            if (DateTime::createFromFormat('m/d/Y', $range[1]) == FALSE) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['End Date format is invalid'],
                ]);
                throw $error;
            }
            $range0 = date('Y-m-d', strtotime($range[0]));
            $range1 = date('Y-m-d', strtotime($range[1]));
            $tickets = $tickets->whereBetween('created_at', [$range0 . " 00:00:00", $range1 . " 23:59:59"]);
            $title = 'My Sorted Tickets';
        }
        if (!is_null($request->department)) {
            $tickets = $tickets->where([
                ['request_by', '=', $request->department]
            ]);
            $title = 'My Sorted Tickets';
        }
        if (!is_null($request->status)) {
            $tickets = $tickets->where([
                ['status', '=', $request->status]
            ]);
            $title = 'My Sorted Tickets';
        }
        $tickets = $tickets->orderBy('id', 'DESC')->get();
        $active = $tickets->where('status', 'Active')->count();
        $onGoing = $tickets->where('status', 'On-Going')->count();
        $resolved = $tickets->where('status', 'Resolved')->count();
        $closed = $tickets->where('status', 'Closed')->count();
//        dd($closed);

        return view('mtickets.mytickets', compact('tickets', 'title', 'departments', 'active', 'onGoing', 'resolved', 'closed'));
    }

    public function index(Request $request)
    {

        $title = 'All Tickets';
        if (Auth::user()->department == "Administrator" || Auth::user()->department == "MICT") {
            $tickets = new mTicket;
        } else {
            $dept = Auth::user()->department;
            $tickets = mTicket::where([
                ['request_by', '=', $dept]
            ]);
            $title = 'My Tickets';
        }
        $departments = Department::all();
        if (!is_null($request->datefilter)) {
            $range = explode(' - ', $request->datefilter);
            if (DateTime::createFromFormat('m/d/Y', $range[0]) == FALSE) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['Start Date format is invalid'],
                ]);
                throw $error;
            }
            if (DateTime::createFromFormat('m/d/Y', $range[1]) == FALSE) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['End Date format is invalid'],
                ]);
                throw $error;
            }
            $range0 = date('Y-m-d', strtotime($range[0]));
            $range1 = date('Y-m-d', strtotime($range[1]));
            $tickets = $tickets->whereBetween('created_at', [$range0 . " 00:00:00", $range1 . " 23:59:59"]);
            $title = 'All Sorted Tickets';
        }
        if (!is_null($request->department)) {
            $tickets = $tickets->where([
                ['request_by', '=', $request->department]
            ]);
            $title = 'All Sorted Tickets';
        }
        if (!is_null($request->status)) {
            $tickets = $tickets->where([
                ['status', '=', $request->status]
            ]);
            $title = 'All Sorted Tickets';
        }
        $tickets = $tickets->orderBy('id', 'DESC')->get();

        return view('mtickets.index', compact('tickets', 'title', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        $micts = User::select('fname')
            ->Where([
                ['department', '=', 'MICT']
            ])
            ->orwhere([
                ['department', '=', 'Administrator']
            ])
            ->get();
        return view('mtickets.create', compact('departments', 'micts'));
    }

    public function show($id)
    {
        $ticket = mTicket::findOrFail($id);
        $comments = mcomments::Where([['id_mticket', '=', $id]])->orderBy('created_at', 'DESC')->get();
        $actions = mactions::Where([['id_mticket', '=', $id]])->orderBy('created_at', 'DESC')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        $shared = mactions::Where([['id_mticket', '=', $id]])->Where('shared', '=', True)->count();
        $departments = Department::all();
        $micts = User::select('fname')
            ->Where([
                ['department', '=', 'MICT']
            ])
            ->orwhere([
                ['department', '=', 'Administrator']
            ])
            ->get();
        return view('mtickets.show', compact('ticket', 'micts', 'departments', 'comments', 'actions', 'shared'));
    }

    public function edit($id)
    {
        $ticket = mTicket::findOrFail($id);
//        dd($ticket->category);
        if (is_null($ticket->acknowledge_by)) {
            $ticket->acknowledge_by = Auth::user()->fname;
            $ticket->save();
        }
        $ticket->is_new = 0;
        $ticket->save();
        $comments = mcomments::Where([['id_mticket', '=', $id]])->orderBy('created_at', 'DESC')->get();
        $actions = mactions::Where([['id_mticket', '=', $id]])->orderBy('created_at', 'DESC')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        $departments = Department::all();
        $micts = User::select('fname')
            ->Where([
                ['department', '=', 'MICT']
            ])
            ->orwhere([
                ['department', '=', 'Administrator']
            ])
            ->get();
//        dd($actions->count());
        return view('mtickets.edit', compact('ticket', 'micts', 'departments', 'comments', 'actions'));
    }

    public function store(TicketFormRequest $request)
    {
        $tickets = new mTicket();

        if ($request->status == "Closed" || $request->status == "Resolve" || $request->status == "Duplicate") {
            if (!is_null($request->finished_at)) {
                $tickets->finished_at = date('Y-m-d H:i:s', strtotime($request->finished_at));
            } else {
                $tickets->finished_at = date('Y-m-d H:i:s', strtotime(Carbon::now()));
            }
        }
        if ($request->status != "Active" || !is_null($request->acknowledge_by)) {
            $tickets->is_new = false;
        }

        if (Auth::user()->department == 'Administrator') {
            if ($request->status == 'On-Going') {
                $tickets->start_at = date('Y-m-d H:i:s', strtotime($request->start_at));
                $tickets->end_at = date('Y-m-d H:i:s', strtotime($request->end_at));
            }
        } elseif (Auth::user()->department == 'MICT') {
            if ($request->status == 'On-Going') {
                $tickets->start_at = date('Y-m-d H:i:s', strtotime($request->start_at));
                $tickets->end_at = date('Y-m-d H:i:s', strtotime($request->end_at));
            }
        }

        if (!is_null($request->assigned_to)) {
            $assign = $request->input('assigned_to');
            $tickets->assigned_to = implode(',', $assign);
        }
        if (!is_null($request->assisted_by)) {
            $assisted = $request->input('assisted_by');
            $tickets->assisted_by = implode(',', $assisted);
        }
        if (!is_null($request->accomplished_by)) {
            $accomplished = $request->input('accomplished_by');
            $tickets->accomplished_by = implode(',', $accomplished);
        }
        $tickets->og_status = $request->og_status;
        $tickets->reported_by = $request->reported_by;
        $tickets->request_by = $request->request_by;
        $tickets->acknowledge_by = $request->acknowledge_by;
        $tickets->status = $request->status;
        $tickets->category = $request->category;
        $tickets->sys_category = $request->sys_category;
        $tickets->concerns = $request->concerns;
        $tickets->lop = $request->lop;
        $tickets->created_by = Auth::user()->fname;
        $tickets->recommendation = $request->recommendation;


        if (!is_null($request->created_at)) {
//           dd( Carbon::now() , date('Y-m-d H:i:s.u', strtotime($request->created_at)));
            $tickets->created_at = date('Y-m-d H:i:s.u', strtotime($request->created_at));
            $tickets->updated_at = Carbon::now();
            $tickets->save(['timestamps' => false]);

        } else {
            $tickets->save();
        }

        if (!is_null($request->action)) {
            $action = new mactions();
            $action->actions = $request->action;
            $action->id_mticket = $tickets->id;
            $action->id_user = Auth::user()->id;
            if ($request->shared === "on") {
                $action->shared = 1;
            } else {
                $action->shared = 0;
            }
            $action->save();
        }
        if ($request->category == 'Others') {

        }
        return redirect('/MICT-Tickets');
    }

    public function comment(Request $request, $id)
    {
//        $ticket = mTicket::findOrFail($id);
//        dd($request->all());
        if (!is_null($request->action)) {
            $action = new mactions();
            $action->actions = $request->action;
            $action->id_mticket = $id;
            $action->id_user = Auth::user()->id;
            $action->save();
        }

        if (!is_null($request->comment)) {
            $comment = new mcomments();
            $comment->comments = $request->comment;
            $comment->id_user = Auth::user()->id;
            $comment->id_mticket = $id;
            $comment->save();
        }
        if (!is_null($request->recommendation)) {
            $ticket = mTicket::findOrFail($id);
            $ticket->recommendation = $request->recommendation;
            $ticket->save();
        }

        return redirect('/MICT-Tickets');
    }

    public function update(TicketFormRequest $request, $id)
    {
        $ticket = mTicket::findOrFail($id);
//        dd($request);
        if ($request->status == "Closed" || $request->status == "Resolve") {
            if (!is_null($request->finished_at)) {
                $ticket->finished_at = date('Y-m-d H:i:s', strtotime($request->finished_at));
            } else {
                $ticket->finished_at = date('Y-m-d H:i:s', strtotime(Carbon::now()));
            }
        }
        if (Auth::user()->department == 'Administrator') {
            if ($request->status == 'On-Going') {
                $ticket->start_at = date('Y-m-d H:i:s', strtotime($request->start_at));
                $ticket->end_at = date('Y-m-d H:i:s', strtotime($request->end_at));
            }
        } elseif (Auth::user()->department == 'MICT') {
            if ($request->status == 'On-Going') {
                $ticket->start_at = date('Y-m-d H:i:s', strtotime($request->start_at));
                $ticket->end_at = date('Y-m-d H:i:s', strtotime($request->end_at));
            }
        }

        if (!is_null($request->assigned_to)) {
            $assign = $request->input('assigned_to');
            $ticket->assigned_to = implode(',', $assign);
        }
        if (!is_null($request->assisted_by)) {
            $assisted = $request->input('assisted_by');
            $ticket->assisted_by = implode(',', $assisted);
        }
        if (!is_null($request->accomplished_by)) {
            $accomplished = $request->input('accomplished_by');
            $ticket->accomplished_by = implode(',', $accomplished);
        }
        if (!is_null($request->action)) {
            $action = new mactions();
            if ($request->shared == "on") {
                $action->shared = 1;
            } else {
                $action->shared = 0;
            }
            $action->actions = $request->action;
            $action->id_mticket = $id;
            $action->id_user = Auth::user()->id;
            $action->save();
        }
        if (!is_null($request->comment)) {
            $comment = new mcomments();
            $comment->comments = $request->comment;
            $comment->id_user = Auth::user()->id;
            $comment->id_mticket = $id;
            $comment->save();
        }
        if (!is_null($request->recommendation)) {
            $ticket = mTicket::findOrFail($id);
            $ticket->recommendation = $request->recommendation;
            $ticket->save();
        }

        $ticket->og_status = $request->og_status;
        $ticket->reported_by = $request->reported_by;
        $ticket->request_by = $request->request_by;
        $ticket->acknowledge_by = $request->acknowledge_by;
        $ticket->status = $request->status;
        $ticket->category = $request->category;
        $ticket->sys_category = $request->sys_category;
        $ticket->concerns = $request->concerns;
        $ticket->lop = $request->lop;
        $ticket->updated_by = Auth::user()->fname;
        $ticket->recommendation = $request->recommendation;

        $ticket->save();
        return redirect('/MICT-Tickets');

    }

    public function report(Request $request)
    {
        $ticket = mTicket::findOrFail($request->ticket_id);
        $actions = $request->action_id;
        if (is_null($actions)) {
//        dd('suc');
            return redirect()->back()->with('alert', 'Unable to proceed no Action is selected');
        }
        $micts = User::select('fname')
            ->Where([
                ['department', '=', 'MICT']
            ])
            ->orwhere([
                ['department', '=', 'Administrator']

            ])
            ->get();
        return view('mtickets.report', compact('actions', 'ticket', 'micts'));
    }

    public function dashboard(Request $request)
    {

        $date = $request->date;

        if (DateTime::createFromFormat('m/Y', $date) == FALSE) {
//            dd('sad');
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'field_name_1' => ['Month format is invalid'],
            ]);
            throw $error;
        }

        $date = explode('/', $date);
        $request->session()->put('month',$date[0]);
        $request->session()->put('year',$date[1]);
        $date = $date[0]. "/01/" . $date[1];
        $request->session()->put('date',$date);

        return redirect('/dashboard');
    }
}
