<?php

namespace App\Http\Controllers;

use App\Department;
use App\mTicket;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportsController extends Controller
{
    public function receivedCalls()
    {
       return view('reports.received_calls');
    }

    public function reportReceivedCalls(Request $request)
    {
        if (!is_null($request->datefilter)) {
            $range = explode(' - ', $request->datefilter);
            if (DateTime::createFromFormat('m/d/Y', $range[0]) == FALSE) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['Start Date format is invalid'],
                ]);
                throw $error;
            }
            if (DateTime::createFromFormat('m/d/Y', $range[1]) == FALSE) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['End Date format is invalid'],
                ]);
                throw $error;
            }
            $range0 = date('Y-m-d', strtotime($range[0]));
            $range1 = date('Y-m-d', strtotime($range[1]));

            $tickets = mTicket::whereBetween('created_at',[$range0, $range1])
                ->orderBy('request_by', 'asc')
                ->get()
                ->groupBy('request_by');
            Session::put('Cdate', $request->datefilter);
        }
        return view('reports.received_calls', compact('tickets'));
    }

    public function printReceivedCalls()
    {
        if(Session::get('Cdate')){
            $range = explode(' - ', Session::get('Cdate'));
            $range0 = date('Y-m-d', strtotime($range[0]));
            $range1 = date('Y-m-d', strtotime($range[1]));

            $tickets = mTicket::whereBetween('created_at',[$range0, $range1])
                ->orderBy('request_by', 'asc')
                ->get()
                ->groupBy('request_by');
            $range = date('F d, Y', strtotime($range[0]))." - ".date('F d, Y', strtotime($range[1])) ;
            return view('reports.print_received_calls', compact('tickets', 'range'));
        }else{
            return redirect('/dashboard');
        }
    }

    public function census()
    {
        return view('reports.census');
    }

    public function reportCensus(Request $request)
    {
        if (!is_null($request->datefilter)) {
            $range = explode(' - ', $request->datefilter);
            if (DateTime::createFromFormat('m/d/Y', $range[0]) == FALSE) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['Start Date format is invalid'],
                ]);
                throw $error;
            }
            if (DateTime::createFromFormat('m/d/Y', $range[1]) == FALSE) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'field_name_1' => ['End Date format is invalid'],
                ]);
                throw $error;
            }
            $range0 = date('Y-m-d', strtotime($range[0]));
            $range1 = date('Y-m-d', strtotime($range[1]));

            $micts = User::where('department','Administrator')
                    ->orwhere('department','MICT')
                    ->get();

            foreach ($micts as $mict) {
                $active[] = mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', 'Like', '%' . "$mict->fname" . '%']])->where('status','Active')->count();
                $on_going[] = mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', 'Like', '%' . "$mict->fname" . '%']])->where('status','On-Going')->count();
                $resolved[] = mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', 'Like', '%' . "$mict->fname" . '%']])->where('status','Resolved')->count();
                $closed[] = mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', 'Like', '%' . "$mict->fname" . '%']])->where('status','Closed')->count();
            }
            $nactive =  mTicket::where([['assigned_to',null]])->where('status','Active')->count();
            $non_going =  mTicket::where([['assigned_to', null]])->where('status','On-Going')->count();
            $nresolved =  mTicket::where([['assigned_to', null]])->where('status','Resolved')->count();
            $nclosed =  mTicket::where([['assigned_to', null]])->where('status','Closed')->count();

            Session::put('Censusdate', $request->datefilter);
        }
        return view('reports.census',compact('micts','active','on_going','resolved','closed','nactive','non_going','nresolved','nclosed'));
    }

    public function printCensus()
    {
        if(Session::get('Censusdate')){
            $range = explode(' - ', Session::get('Censusdate'));
            $range0 = date('Y-m-d', strtotime($range[0]));
            $range1 = date('Y-m-d', strtotime($range[1]));

            $micts = User::where('department','Administrator')
                ->orwhere('department','MICT')
                ->get();

            foreach ($micts as $mict) {
                $active[] = mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', 'Like', '%' . "$mict->fname" . '%']])->where('status','Active')->count();
                $on_going[] = mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', 'Like', '%' . "$mict->fname" . '%']])->where('status','On-Going')->count();
                $resolved[] = mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', 'Like', '%' . "$mict->fname" . '%']])->where('status','Resolved')->count();
                $closed[] = mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', 'Like', '%' . "$mict->fname" . '%']])->where('status','Closed')->count();
            }
            $nactive =  mTicket::where([['assigned_to',null]])->where('status','Active')->count();
            $non_going =  mTicket::where([['assigned_to', null]])->where('status','On-Going')->count();
            $nresolved =  mTicket::where([['assigned_to', null]])->where('status','Resolved')->count();
            $nclosed =  mTicket::where([['assigned_to', null]])->where('status','Closed')->count();

            $range = date('F d, Y', strtotime($range[0]))." - ".date('F d, Y', strtotime($range[1])) ;
            return view('reports.print_census', compact('micts','active','on_going','resolved','closed','nactive','non_going','nresolved','nclosed','range'));
        }else{
            return redirect('/dashboard');
        }
    }
}
