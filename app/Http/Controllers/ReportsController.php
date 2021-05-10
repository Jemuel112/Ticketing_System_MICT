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
    public function actionsUpdate(Request $request)
    {
        dd($request->action_id);
    }
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
            $data = [];
            $tickets = mTicket::whereBetween('created_at',[$range0, $range1])
                ->orderBy('request_by', 'asc')
                ->get()
                ->groupBy('request_by');
            $g_active = 0;
            $g_on_going = 0;
            $g_resolved = 0;
            $g_dublicate = 0;
            $g_closed = 0;
            foreach ($tickets as $key => $ticket){
                $active = 0;
                $on_going = 0;
                $resolved = 0;
                $duplicate = 0;
                $closed = 0;
                foreach ($ticket as $call){
                    if ($call->status == "Active"){
                        $active++;
                    }
                    if ($call->status == "On-Going"){
                        $on_going++;
                    }
                    if ($call->status == "Resolved"){
                        $resolved++;
                    }
                    if ($call->status == "Duplicate"){
                        $duplicate++;
                    }
                    if ($call->status == "Closed"){
                        $closed++;
                    }
                }
                $data[$key][0] = $active;
                $data[$key][1] = $on_going;
                $data[$key][2] = $resolved;
                $data[$key][3] = $duplicate;
                $data[$key][4] = $closed;
                $g_active = $active + $g_active;
                $g_on_going = $on_going + $g_on_going;
                $g_resolved = $resolved + $g_resolved;
                $g_dublicate = $duplicate + $g_dublicate;
                $g_closed = $closed + $g_closed;
            }
            Session::put('Cdate', $request->datefilter);
        }
        return view('reports.received_calls', compact('data','g_active','g_on_going','g_resolved','g_dublicate','g_closed'));
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

            $g_active = 0;
            $g_on_going = 0;
            $g_resolved = 0;
            $g_dublicate = 0;
            $g_closed = 0;
            $data = [];

            foreach ($tickets as $key => $ticket){
                $active = 0;
                $on_going = 0;
                $resolved = 0;
                $duplicate = 0;
                $closed = 0;
                foreach ($ticket as $call){
                    if ($call->status == "Active"){
                        $active++;
                    }
                    if ($call->status == "On-Going"){
                        $on_going++;
                    }
                    if ($call->status == "Resolved"){
                        $resolved++;
                    }
                    if ($call->status == "Duplicate"){
                        $duplicate++;
                    }
                    if ($call->status == "Closed"){
                        $closed++;
                    }
                }
                $data[$key][0] = $active;
                $data[$key][1] = $on_going;
                $data[$key][2] = $resolved;
                $data[$key][3] = $duplicate;
                $data[$key][4] = $closed;
                $g_active = $active + $g_active;
                $g_on_going = $on_going + $g_on_going;
                $g_resolved = $resolved + $g_resolved;
                $g_dublicate = $duplicate + $g_dublicate;
                $g_closed = $closed + $g_closed;
            }

            $range = date('F d, Y', strtotime($range[0]))." - ".date('F d, Y', strtotime($range[1])) ;
            return view('reports.print_received_calls', compact( 'range','data','g_active','g_on_going','g_resolved','g_dublicate','g_closed'));
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
            $nactive =  mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to',null]])->where('status','Active')->count();
            $non_going =  mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', null]])->where('status','On-Going')->count();
            $nresolved =  mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', null]])->where('status','Resolved')->count();
            $nclosed =  mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', null]])->where('status','Closed')->count();
            $t_active = 0;
            $t_on_going = 0;
            $t_resolved = 0;
            $t_closed = 0;


            foreach ($micts as $key =>$mict){
                $t_active = $active[$key] + $t_active;
                $t_on_going = $on_going[$key] + $t_on_going;
                $t_resolved = $resolved[$key] + $t_resolved;
                $t_closed = $closed[$key] + $t_closed;
            }
            Session::put('Censusdate', $request->datefilter);
        }
        return view('reports.census',compact('t_closed','t_resolved','t_on_going','t_active','micts','active','on_going','resolved','closed','nactive','non_going','nresolved','nclosed'));
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
            $nactive =  mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to',null]])->where('status','Active')->count();
            $non_going =  mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', null]])->where('status','On-Going')->count();
            $nresolved =  mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', null]])->where('status','Resolved')->count();
            $nclosed =  mTicket::whereBetween('created_at',[$range0, $range1])->where([['assigned_to', null]])->where('status','Closed')->count();

            $range = date('F d, Y', strtotime($range[0]))." - ".date('F d, Y', strtotime($range[1])) ;
            $t_active = 0;
            $t_on_going = 0;
            $t_resolved = 0;
            $t_closed = 0;
            foreach ($micts as $key =>$mict){
                $t_active = $active[$key] + $t_active;
                $t_on_going = $on_going[$key] + $t_on_going;
                $t_resolved = $resolved[$key] + $t_resolved;
                $t_closed = $closed[$key] + $t_closed;
            }
            return view('reports.print_census', compact('range','t_closed','t_resolved','t_on_going','t_active','micts','active','on_going','resolved','closed','nactive','non_going','nresolved','nclosed'));
        }else{
            return redirect('/dashboard');
        }
    }

    public function Pending()
    {
        return view('reports.pending');
    }

    public function reportPending(Request $request)
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
                ->where(function ($query) {
                    $query->where('status', '=', 'Active')
                        ->orWhere('status', '=', 'On-Going');
                })->where(function ($query) {
                })
                ->orderBy('request_by', 'asc')
                ->get()
                ->groupBy('request_by');
            $g_active = 0;
            $g_on_going = 0;
            $data = [];
            foreach ($tickets as $key => $ticket){
                $active = 0;
                $on_going = 0;
                foreach ($ticket as $call){
                    if ($call->status == "Active"){
                        $active++;
                    }
                    if ($call->status == "On-Going"){
                        $on_going++;
                    }
                }
                $data[$key][0] = $active;
                $data[$key][1] = $on_going;
                $g_active = $active + $g_active;
                $g_on_going = $on_going + $g_on_going;
            }
            Session::put('Pdate', $request->datefilter);
        }
        return view('reports.pending', compact('data','g_active','g_on_going'));
    }

    public function printPending()
    {
        if (Session::get('Pdate')) {
            $range = explode(' - ', Session::get('Pdate'));
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
                ->where(function ($query) {
                    $query->where('status', '=', 'Active')
                        ->orWhere('status', '=', 'On-Going');
                })->where(function ($query) {
                })
                ->orderBy('request_by', 'asc')
                ->get()
                ->groupBy('request_by');
            $g_active = 0;
            $g_on_going = 0;
            $data = [];
            foreach ($tickets as $key => $ticket){
                $active = 0;
                $on_going = 0;
                foreach ($ticket as $call){
                    if ($call->status == "Active"){
                        $active++;
                    }
                    if ($call->status == "On-Going"){
                        $on_going++;
                    }
                }
                $data[$key][0] = $active;
                $data[$key][1] = $on_going;
                $g_active = $active + $g_active;
                $g_on_going = $on_going + $g_on_going;
            }
            $range = date('F d, Y', strtotime($range[0]))." - ".date('F d, Y', strtotime($range[1])) ;
            return view('reports.print_pending', compact('range','data','g_active','g_on_going'));
        }else{
            return redirect('/dashboard');
        }
    }


}

