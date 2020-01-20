<?php

namespace App\Http\Controllers;

use App\Department;
use App\mTicket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MTicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback');
        $this->middleware('auth');

    }

    public function index(Request $request)
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
        return view('mtickets.index', compact('departments', 'micts'));
    }

    public function store(Request $request)
    {
//        dd($request);
        if (Auth::user()->department != 'Administrator' || Auth::user()->department != 'MICT') {
//            dd($request);
            $data = request()->validate([
                'reported_by' => 'required',
                'request_by' => 'required',
                'status' => 'required',
                'category' => 'required',
                'concerns' => 'required|min:8',
            ]);
        } elseif (Auth::user()->department == 'MICT') {
            if ($request->status == 'On-Going') {
                $data = request()->validate([
                    'og_status' => 'required',
                    'start_at' => 'required',
                    'end_at' => 'required',
                ]);
            }

            $data = request()->validate([
                'reported_by' => 'required',
                'request_by' => 'required',
                'status' => 'required',
                'category' => 'required',
                'concerns' => 'required|min:8',
            ]);
        }


//        $data = request()->validate([
//            'og_status',
//            'acknowledge_by',
//            'assigned_by',
//            'assisted_by',
//            'accomplished_by',
//            'category',
//            'sys_category',
//            'lop',
//            'concenrs',
//            'start_at',
//            'end_at',
//        ]);
//        $data = request()->validate([
////            'og_status',
//            'acknowledge_by',
//            'assigned_by',
//            'assisted_by',
//            'accomplished_by',
////            'category',
////            'sys_category',
//            'lop',
//            'concenrs',
////            'start_at',
////            'end_at',
//        ]);
//        $task->start_date = Carbon::now();
//        mTicket::create($data);
        return redirect('/departments');
    }
}
