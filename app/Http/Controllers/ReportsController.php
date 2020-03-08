<?php

namespace App\Http\Controllers;

use App\mTicket;
use App\User;
use DateTime;
use Illuminate\Http\Request;

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

            $mict = User::select('fname')->Where([['department', '=', 'MICT']])
                ->orwhere([
                    ['department', '=', 'Administrator']
                ])
                ->get();
            $active = mTicket::Where('status', '=', 'Resolve')->get()->groupBy('acknowledge_by');
//            $acts = $active->count();
//            ->select('browser', DB::raw('count(*) as total'))

            foreach ($active as $resolve => $count){
                dd($count->count());
            }



//            dd($range0." ".$range1);
//            $tickets = $tickets->whereBetween('created_at', [$range0 . " 00:00:00", $range1 . " 23:59:59"]);
//            $title = 'Sorted Tickets';
        }

        return view('reports.received_calls');
    }
}
