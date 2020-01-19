<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use App\mTicket;
use Illuminate\Http\Request;

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
                ['department','=', 'MICT']
            ])
            ->orwhere([
                ['department','=', 'Administrator']
            ])
            ->get();
        return view('mtickets.index', compact('departments', 'micts'));
    }

    public function store(Request $request)
    {
        dd($request);
        $data = request()->validate([
            'dept_name' => 'required|unique:departments,dept_name',
        ]);
//        $task->start_date = Carbon::now();
        Department::create($data);
        return redirect('/departments');
    }
}
