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
use Illuminate\Support\Str;

class MTicketsController extends Controller
{
    public function __construct()
    {


        $this->middleware('disablepreventback');
        $this->middleware('auth');
        $this->middleware('auth.am')->except('index', 'store', 'create', 'show', 'comment', 'dashboard', 'myTickets');
        $this->middleware('editvalid')->only('show');

//        $this->middleware('auth.admin')->only('index', 'store', 'allticket');
    }

    public function myTickets(Request $request)
    {

        $title = 'My Tickets';
        $departments = Department::all();
        if (Auth::user()->department == "Administrator" || Auth::user()->department == "MICT") {
            $name = Auth::user()->fname;
            $tickets = mTicket::where([['assigned_to', 'Like', '%' . "$name" . '%']]);
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
        } else {
            $tickets = mTicket::where('request_by', '=', Auth::user()->department);
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
            if (!is_null($request->status)) {
                $tickets = $tickets->where([
                    ['status', '=', $request->status]
                ]);
                $title = 'My Sorted Tickets';
            }
        }
        $tickets = $tickets->orderBy('id', 'DESC')->get();
        $active = $tickets->where('status', 'Active')->count();
        $onGoing = $tickets->where('status', 'On-Going')->count();
        $resolved = $tickets->where('status', 'Resolved')->count();
        $closed = $tickets->where('status', 'Closed')->count();

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
//        alert()->info('Post Created', 'Successfully');

        return view('mtickets.index', compact('tickets', 'title', 'departments'))->with('success', 'test');
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
        if (is_null($ticket->acknowledge_by) && $ticket->is_new == 1) {
            $ticket->acknowledge_by = Auth::user()->fname;
        }
        $ticket->is_new = 0;
        $comments = mcomments::Where([['id_mticket', '=', $id]])->orderBy('created_at', 'DESC')->get();
        if($ticket->getOriginal('acknowledge_by') != $ticket->acknowledge_by){
            $action = new mactions();
            $action->shared = 0;       
            $action->actions = "User: ".Auth::user()->fname." ".Auth::user()->lname. " ID: ".Auth::user()->id."<br/> Change the Acknowledge by from ". $ticket->getOriginal('acknowledge_by') . " to " . $ticket->acknowledge_by;
            $action->id_mticket = $id;
            $action->id_user = 0;
            $action->save();
        }
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

        $ticket->save();
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
        $tickets->created_by = Auth::user()->fname . " ( " . Auth::user()->id . " )";
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

//        event(new MTicket());
        
        return redirect('/MICT-Tickets')->with('message', 'Ticket #' . $tickets->id . ' has been Created!');
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

        $ticket->og_status = $request->og_status;
        $ticket->sys_category = $request->sys_category;
        $ticket->reported_by = $request->reported_by;
        $ticket->request_by = $request->request_by;
        $ticket->acknowledge_by = $request->acknowledge_by;
        $ticket->status = $request->status;
        $ticket->category = $request->category;
        $ticket->concerns = $request->concerns;
        $ticket->lop = $request->lop;
        $ticket->updated_by = Auth::user()->fname;
        $ticket->recommendation = $request->recommendation;
        
        if($ticket->isDirty()){
            $action = new mactions();
            $action->shared = 0;   
            $action->actions = "User: <b>".Auth::user()->fname." ".Auth::user()->lname."</b>    ID: <b>".Auth::user()->id. "</b> <br> <b>Has Changed the following details below</b>";
            if($ticket->isDirty('reported_by')){
                $action->actions .= "<br> Reported by from <b>'". $ticket->getOriginal('reported_by')."'</b> to <b>'". $ticket->reported_by."'</b>";
            }
            if($ticket->isDirty('request_by')){
                $action->actions .= "<br> Requested by from <b>'". $ticket->getOriginal('request_by')."'</b> to <b>'". $ticket->request_by."'</b>";
            }
            if($ticket->isDirty('status')){
                $action->actions .= "<br> Status from <b>'". $ticket->getOriginal('status')."'</b> to <b>'". $ticket->status."'</b>";
            }
            if($ticket->isDirty('og_status')){
                $action->actions .= "<br> On-Going Status from <b>'". $ticket->getOriginal('og_status')."'</b> to <b>'". $ticket->og_status."'</b>";
            }
            if($ticket->isDirty('start_at')){
                $action->actions .= "<br> Date to Start from <b>'". $ticket->getOriginal('start_at')."'</b> to <b>'". $ticket->start_at."'</b>";
            }
            if($ticket->isDirty('end_at')){
                $action->actions .= "<br> Deadline from <b>'". $ticket->getOriginal('end_at')."'</b> to <b>'". $ticket->end_at."'</b>";
            }
            if($ticket->isDirty('acknowledge_by')){
                $action->actions .= "<br> Acknowledge by from <b>'". $ticket->getOriginal('acknowledge_by')."'</b> to <b>'". $ticket->acknowledge_by."'</b>";
            }
            if($ticket->isDirty('assigned_to')){
                $action->actions .= "<br> Assigned to from <b>'". $ticket->getOriginal('assigned_to')."'</b> to <b>'". $ticket->assigned_to."'</b>";
            }
            if($ticket->isDirty('assisted_by')){
                $action->actions .= "<br> Assisted by from <b>'". $ticket->getOriginal('assisted_by')."'</b> to <b>'". $ticket->assisted_by."'</b>";
            }
            if($ticket->isDirty('accomplished_by')){
                $action->actions .= "<br> Accomplished by from <b>'". $ticket->getOriginal('accomplished_by')."'</b> to <b>'". $ticket->accomplished_by."'</b>";
            }
            if($ticket->isDirty('category')){
                $action->actions .= "<br> Category from <b>'". $ticket->getOriginal('category')."'</b> to <b>'". $ticket->category."'</b>";
            }
            if($ticket->isDirty('sys_category')){
                $action->actions .= "<br> System Category from <b>'". $ticket->getOriginal('sys_category')."'</b> to <b>'". $ticket->sys_category."'</b>";
            }
            if($ticket->isDirty('lop')){
                $action->actions .= "<br> Level of Priority from <b>'". $ticket->getOriginal('lop')."'</b> to <b>'". $ticket->lop."'</b>";
            }
            if($ticket->isDirty('concerns')){
                $action->actions .= "<br> Concern from <b>'". $ticket->getOriginal('concerns')."'</b> to <b>'". $ticket->concerns."'</b>";
            }
            if($ticket->isDirty('recommendation')){
                $action->actions .= "<br> Recommendation from <b>'". $ticket->getOriginal('recommendation')."'</b> to <b>'". $ticket->recommendation."'</b>";
            }
            $action->id_mticket = $id;
            $action->id_user = 0;
            $action->save();
        }
        // if($ticket->getOriginal('acknowledge_by') != $ticket->acknowledge_by){
        //     $action = new mactions();
        //     $action->shared = 0;       
        //     $action->actions = "User: ".Auth::user()->fname." ".Auth::user()->lname. " ID: ".
        //     Auth::user()->id."<br/> Change the Acknowledge by from ". $ticket->getOriginal('acknowledge_by') . " to " . $ticket->acknowledge_by;
        //     $action->id_mticket = $id;
        //     $action->id_user = 0;
        //     $action->save();
        // }
        if ($request->action_id_edit) {
            $action_id = $request->action_id_edit;
            foreach ($action_id as $id) {
                $action = mactions::find($id);
                if (Str::contains($action->shared, '0')) {
                    $action->shared = 1;
                } else {
                    $action->shared = 0;
                }
                $action->save();
            }
        }
        $ticket->save();

        return redirect('/MICT-Tickets')->with('message', 'Ticket #' . $ticket->id . ' has been Updated!');

//        alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
//        alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
//        alert()->success('Post Created', '<strong>Successfully</strong>')->toHtml();
        // example:
        // event(new MTicket());


    }

    public function report(Request $request)
    {
        $ticket = mTicket::findOrFail($request->ticket_id);
        $actions = $request->action_id;
        if (is_null($actions)) {
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
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'field_name_1' => ['Month format is invalid'],
            ]);
            throw $error;
        }

        $date = explode('/', $date);
        $request->session()->put('month', $date[0]);
        $request->session()->put('year', $date[1]);
        $date = $date[0] . "/01/" . $date[1];
        $request->session()->put('date', $date);

        return redirect('/dashboard');
    }
}
