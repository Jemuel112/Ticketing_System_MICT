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
use phpDocumentor\Reflection\Types\Null_;

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
        if (Auth::user()->department == "Administrator" || Auth::user()->department == "MICT") {
            $endorsements = Endorsement::all();
        } else {
            $user = Auth::user()->id;
            $dept = Department::select('id')->where('dept_name', Auth::user()->department)->first();
            $endors = Endorsement::whereOr([['assigned_to_id', 'Like', '%' . "$user" . '%']])
                            ->whereOr('assigned_dept_id', 'Like', '%' . "$dept->id" . '%')
                            ->get();
            foreach ($endors as $endor){
                $assign = explode(', ',$endor->assigned_to_id);
                $depts = explode(', ', $endor->assigned_dept_id);
                if (in_array($user, $assign)){
                    $endorsements[] = $endor;
                }elseif (in_array($dept->id, $depts)){
                    $endorsements[] = $endor;
                }
            }
        }
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
        } else {
            $endorse->ticket_id = null;
        }

        if ($request->assigned_to) {
            $endorse->assigned_to_id = implode(', ', $request->assigned_to);
        } else {
            $endorse->assigned_to_id = null;
        }

        if ($request->departments) {
            if ($request->departments[0] == "All Department") {
                foreach (Department::all() as $department) {
                    $dept[] = $department->id;
                }
                $endorse->assigned_dept_id = implode(', ', $dept);

            } else {
                $endorse->assigned_dept_id = implode(', ', $request->departments);
            }
        } else {
            $endorse->assigned_dept_id = null;
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
                $end_file->org_file_name = pathinfo($orig_filename, PATHINFO_FILENAME) . "." . $file->getClientOriginalExtension();
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
        $endorse = Endorsement::find($id);
        $user = User::findOrFail($endorse->created_by_id);
        $files = EndorsmentFiles::where('endorse_id', $id)->get();
        if (is_null($endorse->assigned_to_id)) {
            $to = null;
        } else {
            $to1 = explode(', ', $endorse->assigned_to_id);
            foreach ($to1 as $users) {
                $to[] = User::find($users);
            }
        }

        if (is_null($endorse->assigned_dept_id)) {
            $departments = null;
        } else {
            $department = explode(', ', $endorse->assigned_dept_id);
            foreach ($department as $depts) {
                $departments[] = Department::find($depts);
            }
        }
        return view('endorsement.show', compact('endorse', 'user', 'users', 'files', 'to', 'departments', 'files'));
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
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'assigned_to' => 'required_without:departments',
            'departments' => '',
            'ticket' => '',
            'title' => 'required',
            'body' => 'required',
        ]);
        $endorse = Endorsement::findOrFail($id);
        $endorse->title = $request->title;
        $endorse->body = $request->body;
        if ($request->ticket) {
            $endorse->ticket_id = implode(', ', $request->ticket);
        } else {
            $endorse->ticket_id = null;
        }
        if ($request->assigned_to) {
            $endorse->assigned_to_id = implode(', ', $request->assigned_to);
        } else {
            $endorse->assigned_to_id = null;
        }
        if ($request->departments) {
            if ($request->departments[0] == "All Department") {
                foreach (Department::all() as $department) {
                    $dept[] = $department->id;
                }
                $endorse->assigned_dept_id = implode(', ', $dept);
            } else {
                $endorse->assigned_dept_id = implode(', ', $request->departments);
            }
        } else {
            $endorse->assigned_dept_id = null;
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
                $end_file->org_file_name = pathinfo($orig_filename, PATHINFO_FILENAME) . "." . $file->getClientOriginalExtension();
                $end_file->endorse_id = $id;
                $end_file->extension_name = $file->getClientOriginalExtension();
                $end_file->save();
            }
        }
        return redirect()->route('Endorsement.index');
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
//        $directory = "storage\\endorsment_files\\$d_id\\$file->file_name";
        $directory = "app\\public\\endorsment_files\\$d_id\\$file->file_name";
        $name = $file->org_file_name;
        return Response::download(storage_path($directory, $name));

//        dd($directory);
//        return Storage::download(public_path($directory));
//        return response()->download(public_path($directory, $name));
    }
}
