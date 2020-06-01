<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\mTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MICTController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ticketCounter()
    {
        $new = mTicket::where('is_new',True)->count();
        $myActive = mTicket::where([['assigned_to', 'Like', '%' . Auth::user()->fname . '%']])->where([['status', '=', 'Active']])->count();
        return [
            'new' => $new,
            'active' => $myActive,
        ];

    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token){
            $token->delete();
        });

        return response()->json('Logged out successful', 200);
    }
}
