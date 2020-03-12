<?php

namespace App\Http\Controllers;

use App\Department;
use App\Endorsement;
use App\EndorsmentFiles;
use App\mTicket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class EndorsementController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback')->except('download');
        $this->middleware('auth');
//        $this->middleware('auth.am')->except('index', 'store', 'create', 'show', 'comment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $endorsements = Endorsement::all();
        return view('endorsement.index', compact('endorsements'));
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

            if($request->departments[0] == "All Department"){
                foreach (Department::all() as $department){
                    $dept[] = $department->id;
                }
                $endorse->assigned_dept_id = implode(', ', $dept);
            }else{
                $endorse->assigned_dept_id = implode(', ', $request->departments);
            }
        }
        $endorse->save();

        if ($request->attachment) {
            $id = $endorse->id;
            $directory = "public/endorsment_files/$id";
            $files = $request->attachment;
            foreach ($files as $file) {
                $unique = Str::uuid()->getTimeMidHex();
                $orig_filename = $file->getClientOriginalName();
                $unique_filename = "[" . $unique . "]" . $orig_filename . "." . $file->getClientOriginalExtension();
                $file->storeAs($directory, $unique_filename);

                $end_file = new EndorsmentFiles();
                $end_file->file_name = pathinfo($unique_filename, PATHINFO_FILENAME);
                $end_file->org_file_name = pathinfo($orig_filename, PATHINFO_FILENAME).".".$file->getClientOriginalExtension();
                $end_file->endorse_id = $id;
                $end_file->extension_name = $file->getClientOriginalExtension();
                $end_file->save();
            }
        }
        return redirect('/Endorsement');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Endorsement $endorsement
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $endorse = Endorsement::findOrFail($id);
        $user = User::findOrFail($endorse->created_by_id);
        $files = EndorsmentFiles::where('endorse_id', $id);
        $to = explode(', ', $endorse->assigned_to_id);
        $departments = explode(', ', $endorse->assigned_dept_id);
        $files = EndorsmentFiles::where('endorse_id', $id)->get();
//        foreach ($files as $file) {
////            dd($file->getClientOriginalExtension());
//
////            $sad = $file->getClientOriginalExtension();
//        }


        return view('endorsement.show', compact('endorse', 'user', 'files', 'to', 'departments', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Endorsement $endorsement
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $endorsement = Endorsement::findOrFail($id);
        $users = User::all();
        $departments = Department::all();
        $tickets = mTicket::all();
        $files = EndorsmentFiles::where('endorse_id', $id)->get();
        return view('endorsement.edit', compact('endorsement', 'users', 'departments', 'tickets', 'files'));
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

    public function download($id)
    {
        $file = EndorsmentFiles::findOrFail($id);
        $d_id = $file->endorse_id;
        $directory = "storage\\endorsment_files\\$d_id\\$file->file_name";
        $name = $file->org_file_name;
//        dd($directory);
//        return Storage::download(public_path($directory));
//        return response()->download(public_path($directory, $name));
        return Response::download($directory, $name);
    }
}
