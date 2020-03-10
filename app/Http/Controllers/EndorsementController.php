<?php

namespace App\Http\Controllers;

use App\Department;
use App\Endorsement;
use App\EndorsmentFiles;
use App\mTicket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EndorsementController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback');
        $this->middleware('auth');
        $this->middleware('auth.am')->except('index', 'store', 'create', 'show', 'comment');
        $this->middleware('editvalid')->only('show');

//        $this->middleware('auth.admin')->only('index', 'store', 'allticket');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $endors = Endorsement::all();
        return view('endorsement.index', compact('endors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $departments = Department::all();
        $tickets = mTicket::all();
        return view('endorsement.create', compact('users', 'departments', 'tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'assigned_to' => 'required_without:departments',
            'departments' => '',
            'ticket' => '',
            'title' => 'required',
            'body' => 'required',
        ]);
        $endorse = new Endorsement();
        $endorse->title = $request->title;
        $endorse->body = $request->body;
        $endorse->created_by_id = Auth::user()->id;
        if ($request->ticket) {
            $endorse->ticket_id = implode(', ', $request->ticket);
        }
        if ($request->assigned_to) {
            $endorse->assigned_to_id = implode(', ', $request->assigned_to);
        }
        if ($request->departments) {
            $endorse->assigned_dept_id = implode(', ', $request->departments);
        }
        $endorse->save();

        if ($request->attachment) {
            $id = $endorse->id;
            $directory = "endorsment_files/$id";
            $files = $request->attachment;
            foreach ($files as $file) {
                $unique = Str::uuid()->getTimeMidHex();
                $orig_filename = $file->getClientOriginalName();
                $unique_filename = "[" . $unique . "]" . $orig_filename;
                $file->storeAs($directory, $unique_filename);

                $end_file = new EndorsmentFiles();
                $end_file->file_name = $unique_filename;
                $end_file->org_file_name = $orig_filename;
                $end_file->endorse_id = $id;
                $end_file->save();
            }
        }
        return view('endorsement.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Endorsement $endorsement
     * @return \Illuminate\Http\Response
     */
    public function show(Endorsement $endorsement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Endorsement $endorsement
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $endor = Endorsement::findOrFail($id);
        $users = User::all();
        $departments = Department::all();
        $tickets = mTicket::all();
        return view('endorsement.edit', compact('endor','users', 'departments', 'tickets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Endorsement $endorsement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Endorsement $endorsement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Endorsement $endorsement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Endorsement $endorsement)
    {
        //
    }
}
