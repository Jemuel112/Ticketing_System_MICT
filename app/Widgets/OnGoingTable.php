<?php

namespace App\Widgets;

use App\mTicket;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;

class OnGoingTable extends AbstractWidget
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
     */
    public function run()
    {
        if(Auth::user()->department == "Administrator" || Auth::user()->department =="MICT"){
//        $tickets = mTicket::where('status', '=', 'Active')->get();
            $tickets = mTicket::where('status', '=', 'On-Going')->get()->groupBy(function ($item) {
                return $item->request_by;
            });
        }else{
            $tickets = mTicket::where('request_by','=', Auth::user()->department)->where('status', '=','On-Going')->get();
        }
        return view('widgets.on_going_table', [
            'config' => $this->config,
            'tickets' => $tickets,
        ]);
    }
}
