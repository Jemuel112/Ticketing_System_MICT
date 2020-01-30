<?php

namespace App\Widgets;

use App\mTicket;
use Arrilot\Widgets\AbstractWidget;

class ClosedWidget extends AbstractWidget
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
    public $reloadTimeout = 1;


    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $tickets = mTicket::where('status', '=', 'Closed')->count();
        $utickets = mTicket::where('request_by','=',\Illuminate\Support\Facades\Auth::user()->department)->where('status', '=','Closed')->count();
        return view('widgets.closed_widget', [
            'config' => $this->config,
            'tickets' => $tickets,
            'utickets' => $utickets,
        ]);
    }
}
