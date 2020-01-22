<?php

namespace App\Http\Controllers;

use App\Department;
use App\mTicket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class MTicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback');
        $this->middleware('auth');
        //$this->middleware('auth.am')->except('index','store','allticket');
        $this->middleware('auth.admin')->only('index', 'store', 'allticket');

    }

    public function index(Request $request)
    {
        $tickets = mTicket::all();
        return view('mtickets.index', compact('tickets'));
    }

    public function create(Request $request)
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

    public function store(Request $request)
    {

        dd( Input::all() );
//                dd($request);
        if (Auth::user()->department == 'Administrator') {
//            dd($request);
            if ($request->status == 'On-Going') {
//                dd($request->status);
                $data = request()->validate([
                    'og_status' => 'required',
                    'start_at' => 'required',
                    'end_at' => 'required',
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
        $ticket = new mTicket;
        $ticket->created_at = 'created_at';
        $ticket->created_by = 'created_by';
        $ticket->save();
        mTicket::create($data);
        return view('mtickets.index');
    }
}
