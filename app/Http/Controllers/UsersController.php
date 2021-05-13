<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback');
        $this->middleware('auth');
        $this->middleware('useronly')->only('update', 'edit');
        $this->middleware('auth.am')->only('index');

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
        $user = User::create([
            'username' => $data['username'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'department' => $data['department'],
            'password' => bcrypt($data['password']),
        ]);
        return redirect('/users')->with('message', 'Username "' . $user->username . '" has been Added!');
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

        if (Auth::user()->department != "Administrator") {
            if (Auth::user()->department != "MICT") {
                if ($request->password == null) {
                    $data = request()->validate([
                        'username' => "required|unique:users,username,$id|max:255",
                        'fname' => 'required|max:255',
                        'lname' => 'required|max:255',
                    ]);
                } else {
                    $data = request()->validate([
                        'username' => "required|unique:users,username,$id|max:255",
                        'fname' => 'required|max:255',
                        'lname' => 'required|max:255',
                        'department' => 'required',
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]);
                }
                $user->update($data);
                return redirect('/users/' . Auth::user()->id)->with('message', 'User Updated!');
            }
        }
        if ($request->password == null) {
            $data = request()->validate([
                'username' => "required|unique:users,username,$id|max:255",
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'department' => 'required',
            ]);
            $user->update($data);
        } else {
            $data = request()->validate([
                'username' => "required|unique:users,username,$id|max:255",
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'department' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update($data);
            $user->update([
                'password' => bcrypt($data['password']),
            ]);
        }
        if ($user->id == 1){
            $user->department == "Administrator";
        }
        return redirect('/users')->with('message', 'Username "' . $user->username . '" has been updated!');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('message bad', 'Department Name "' . $user->username . '" has been Deleted Successfully!');
    }
}
