<?php

namespace App\Widgets;

use App\mTicket;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnGoingWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */
    public $reloadTimeout = 5;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(Request $request)
    {
        if (Auth::user()->department == "Administrator" || Auth::user()->department == "MICT") {
            if ($request->session()->has('date')){
//                dd('sad');
                $month = $request->session()->get('month');
                $year = $request->session()->get('year');
                $tickets = mTicket::whereYear('created_at',$year)
                    ->whereMonth('created_at', $month)
                    ->where('status', '=', 'On-Going')
                    ->count();
            }else{
                $year = date( Carbon::now()->format('Y'));
                $month = date( Carbon::now()->format('m'));
                $tickets = mTicket::whereYear('created_at',$year)
                    ->whereMonth('created_at', $month)
                    ->where('status', '=', 'On-Going')
                    ->count();
            }
        } else {
            $tickets = mTicket::where('request_by', '=', Auth::user()->department)->where('status', '=', 'On-Going')->count();
        }
        return view('widgets.on_going_widget', [
            'config' => $this->config,
            'tickets' => $tickets,
        ]);
    }
}
