<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ETicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('disablepreventback');
        $this->middleware('auth');
    }
    public function create()
    {
        return view('etickets.create');
    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }
}
