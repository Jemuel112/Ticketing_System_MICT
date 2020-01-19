<?php

namespace App\Http\Controllers;

use App\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback');
        $this->middleware('auth');
        $this->middleware('auth.am');
    }

    public function index()
    {
        $departments = Department::all();
        return view('department.index',compact('departments'));
    }

    public function store(Department $department)
    {
//        dd(Carbon::now());  ;
        $data = request()->validate([
            'dept_name' => 'required|unique:departments,dept_name',
        ]);
//        $task->start_date = Carbon::now();
        Department::create($data);
        return redirect('/departments');
    }

    public function edit(Department $department)
    {
        return view('department.show', compact('department'));
    }

    public function show(Department $department)
    {
        return view('department.show',compact('department'));
    }

    public function update(Request $department)
    {
        $id = $department->id;
        $data = request()->validate([
            'dept_name' => "required|unique:departments,dept_name,$id",
        ]);

        $department->update($data);
        return redirect('/departments');

    }

    public function destroy(Department $department)
    {
        $department -> delete();
        return redirect('/departments');
    }
}
