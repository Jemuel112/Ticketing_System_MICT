<?php

namespace App\Http\Controllers;

use App\Endorsement;
use Illuminate\Http\Request;

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
        return view('endorsement.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('endorsement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd('sample');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Endorsement  $endorsement
     * @return \Illuminate\Http\Response
     */
    public function show(Endorsement $endorsement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Endorsement  $endorsement
     * @return \Illuminate\Http\Response
     */
    public function edit(Endorsement $endorsement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Endorsement  $endorsement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Endorsement $endorsement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Endorsement  $endorsement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Endorsement $endorsement)
    {
        //
    }
}
