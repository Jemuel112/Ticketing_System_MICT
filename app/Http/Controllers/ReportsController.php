<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function receivedCalls()
    {
//        dd('demo');
       return view('reports.received_calls');
    }
}
