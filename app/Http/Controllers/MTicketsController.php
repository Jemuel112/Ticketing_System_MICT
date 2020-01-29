<?php

namespace App\Http\Controllers;

use App\Department;
use App\mTicket;
use App\User;
use App\mcomments;
use App\mactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MTicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback');
        $this->middleware('auth');
        $this->middleware('auth.am')->except('index', 'store', 'create', 'show','comment');
        $this->middleware('editvalid')->only('show');
//        $this->middleware('auth.admin')->only('index', 'store', 'allticket');
    }

    public function myTickets()
    {
        $name = Auth::user()->fname;
//        $tickets = mTicket::where('category','LIKE',$name);
//        $tickets = DB::table('m_tickets')->keyBy('assigned_to');
//        $query="SELECT * FROM m_tickets WHERE ({implode(',',assigned_to)}) IN $name";
        //        assigned_to
//        $query = mTicket::where('assigned_to', 'Administrator')->count();

        $tickets = mTicket::where([['assigned_to', 'Like', '%'."$name".'%']])->get();
//        dd($tickets);

        return view('mtickets.index', compact('tickets'));
    }

    public function index(Request $request)
    {

        if (Auth::user()->department == "Administrator" || Auth::user()->department == "MICT") {
            $tickets = mTicket::all();
        } else {
//            dd(Auth::user()->department);
            $dept = Auth::user()->department;
            $tickets = mTicket::where([
                ['request_by', '=', $dept]
            ])
                ->get();
        }
        return view('mtickets.index', compact('tickets'));
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
        $comments = mcomments::Where([['id_mticket','=',$id]])->orderBy('created_at', 'DESC')->get();
        $actions = mactions::Where([['id_mticket','=',$id]])->orderBy('created_at', 'DESC')->get()->groupBy(function($item) {
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
//        dd($comments);
        return view('mtickets.show', compact('ticket', 'micts', 'departments','comments','actions'));
    }

    public function edit($id)
    {
        $ticket = mTicket::findOrFail($id);
        $comments = mcomments::Where([['id_mticket','=',$id]])->orderBy('created_at', 'DESC')->get();
        $actions = mactions::Where([['id_mticket','=',$id]])->orderBy('created_at', 'DESC')->get()->groupBy(function($item) {
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
        return view('mtickets.edit', compact('ticket', 'micts', 'departments','comments','actions'));
    }

    public function store(Request $request)
    {

        $tickets = new mTicket();
        if (Auth::user()->department == 'Administrator') {
//            dd($request);
            if ($request->status == 'On-Going') {
//                dd($request->status);
                $data = request()->validate([
                    'og_status' => 'required',
                    'start_at' => 'required',
                    'end_at' => 'required',
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'acknowledge_by' => 'required',
                    'assigned_to' => '',
                    'assisted_by' => '',
                    'accomplished_by' => '',
                    'status' => 'required',
                    'category' => 'required',
                    'sys_category' => '',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                    'created_at' => '',
                ]);

                $tickets->start_at = date('Y-m-d H:i:s', strtotime($request->start_at));
                $tickets->end_at = date('Y-m-d H:i:s', strtotime($request->end_at));
            } else {
                $data = request()->validate([
                    'create_at' => '',
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'acknowledge_by' => 'required',
                    'assigned_to' => '',
                    'assisted_by' => '',
                    'accomplished_by' => '',
                    'status' => 'required',
                    'category' => 'required',
                    'sys_category' => '',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                ]);
            }
        } elseif (Auth::user()->department == 'MICT') {
            if ($request->status == 'On-Going') {
                $data = request()->validate([
                    'og_status' => 'required',
                    'start_at' => 'required',
                    'end_at' => 'required',
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'acknowledge_by' => 'required',
                    'status' => 'required',
                    'category' => 'required',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                ]);
                $tickets->start_at = date('Y-m-d H:i:s', strtotime($request->start_at));
                $tickets->end_at = date('Y-m-d H:i:s', strtotime($request->end_at));
            } else {
                $data = request()->validate([
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'status' => 'required',
                    'acknowledge_by' => 'required',
                    'category' => 'required',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                ]);
            }
        } else {
            $data = request()->validate([
                'reported_by' => 'required',
                'request_by' => 'required',
                'status' => 'required',
                'category' => 'required',
                'concerns' => 'required|min:8',
            ]);
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

//        dd($tickets->assigned_to);

        if (is_null($request->created_at)) {
//            dd($request->created_at);
            $tickets->save();
        } else {
            $tickets->created_at = date('Y-m-d H:i:s', strtotime($request->created_at));
            $tickets->updated_at = Carbon::now();
            $tickets->save(['timestamps' => false]);
        }

        if(!is_null($request->action)){
            $data = request()->validate([
                'action' => 'required'
            ]);
            $action = new mactions();
            $action->actions = $request->action;
            $action->id_mticket = $tickets->id;
            $action->id_user = Auth::user()->id;
            if ($request->shared === "on" ){
                $action->shared = 1;
            }else{
                $action->shared = 0;
            }
            $action->save();
        }

        return redirect('/MICT-Tickets');
    }

    public function comment(Request $request, $id)
    {
//        $ticket = mTicket::findOrFail($id);
//        dd($request->all());
        if(!is_null($request->action)){
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
        if(!is_null($request->recommendation)){
            $ticket = mTicket::findOrFail($id);
            $ticket->recommendation = $request->recommendation;
            $ticket->save();
        }

        return redirect('/MICT-Tickets');
    }

    public function update(Request $request, $id)
    {
        $ticket = mTicket::findOrFail($id);
//        dd($id);

        if (Auth::user()->department == 'Administrator') {
//            dd($request);
            if ($request->status == 'On-Going') {
//                dd($request->status);
                $data = request()->validate([
                    'og_status' => 'required',
                    'start_at' => 'required',
                    'end_at' => 'required',
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'acknowledge_by' => 'required',
                    'assigned_to' => '',
                    'assisted_by' => '',
                    'accomplished_by' => '',
                    'status' => 'required',
                    'category' => 'required',
                    'sys_category' => '',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                    'created_at' => '',
                ]);

                $ticket->start_at = date('Y-m-d H:i:s', strtotime($request->start_at));
                $ticket->end_at = date('Y-m-d H:i:s', strtotime($request->end_at));
            } else {
                $data = request()->validate([
                    'create_at' => '',
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'acknowledge_by' => 'required',
                    'assigned_to' => '',
                    'assisted_by' => '',
                    'accomplished_by' => '',
                    'status' => 'required',
                    'category' => 'required',
                    'sys_category' => '',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                ]);
            }
        } elseif (Auth::user()->department == 'MICT') {
            if ($request->status == 'On-Going') {
                $data = request()->validate([
                    'og_status' => 'required',
                    'start_at' => 'required',
                    'end_at' => 'required',
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'acknowledge_by' => 'required',
                    'status' => 'required',
                    'category' => 'required',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                ]);
                $ticket->start_at = date('Y-m-d H:i:s', strtotime($request->start_at));
                $ticket->end_at = date('Y-m-d H:i:s', strtotime($request->end_at));
            } else {
                $data = request()->validate([
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'status' => 'required',
                    'acknowledge_by' => 'required',
                    'category' => 'required',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                ]);
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
        if(!is_null($request->action)){
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
        if(!is_null($request->recommendation)){
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

        $ticket->update();
        return redirect('/MICT-Tickets');

    }
}
