<?php

namespace App\Http\Controllers;

use App\Department;
use App\mTicket;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MTicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback');
        $this->middleware('auth');
        $this->middleware('auth.am')->except('index', 'store', 'create', 'show');
        $this->middleware('editvalid')->only('show');
//        $this->middleware('auth.admin')->only('index', 'store', 'allticket');

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
        $departments = Department::all();
        $micts = User::select('fname')
            ->Where([
                ['department', '=', 'MICT']
            ])
            ->orwhere([
                ['department', '=', 'Administrator']
            ])
            ->get();
        return view('mtickets.show', compact('ticket', 'micts', 'departments'));
    }

    public function store(Request $request)
    {
        $tickets = new mTicket();
//        dd( Input::all() );
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
                    'created_by' => '',
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
                    'created_by' => '',
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
                    'created_by' => '',
                ]);
            } else {
                $data = request()->validate([
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'status' => 'required',
                    'acknowledge_by' => 'required',
                    'category' => 'required',
                    'concerns' => 'required|min:8',
                    'lop' => 'required',
                    'created_by' => '',
                ]);
            }
            $assign = $request->input('assigned_to');
            $assisted = $request->input('assisted_by');
            $accomplished = $request->input('accomplished_by');
            $tickets->assigned_to = implode(',', $assign);
            $tickets->assisted_by = implode(',', $assisted);
            $tickets->accomplished_by = implode(',', $accomplished);
        } else {
            $data = request()->validate([
                'reported_by' => 'required',
                'request_by' => 'required',
                'status' => 'required',
                'category' => 'required',
                'concerns' => 'required|min:8',
                'created_by' => '',
            ]);
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
        $tickets->created_by = $request->created_by;
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

        return redirect('/MICT-Tickets');
    }


}
