<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Http\Request;


class UsersController extends Controller
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
        $users = User::all();
        return view('users.index', compact('users', 'departments'));
    }

    public function store()
    {
        $data = request()->validate([
            'username' => 'required|unique:users,username|max:255',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'department' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
//        $task->start_date = Carbon::now();
        User::create([
            'username' => $data['username'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'department' => $data['department'],
            'password' => bcrypt($data['password']),
        ]);
        return redirect('/users');
    }


    public function edit(User $user)
    {
        $users = User::all();
        $departments = Department::all();
        return view('users.show', compact('users', 'user', 'departments'));
    }

    public function show(User $user)
    {
        $users = User::all();
        $departments = Department::all();
        return view('users.show', compact('users', 'user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        $id = $user->id;

        if ($request->password == null) {
//            dd($request->password);
            $data = request()->validate([
                'username' => "required|unique:users,username,$id|max:255",
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'department' => 'required',
            ]);
            $user->update($data);
            return redirect('/users');
        } else {
            $data = request()->validate([
                'username' => "required|unique:users,username,$id|max:255",
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'department' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
//            dd($user);
            $user->update($data);
            $user->update([
                'password' => bcrypt($data['password']),
            ]);
            return redirect('/users');
        }

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}
