<?php

namespace App\Widgets;

use App\mTicket;
use Illuminate\Support\Facades\Auth;
use Arrilot\Widgets\AbstractWidget;

class ActiveWidget extends AbstractWidget
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
        $tickets = mTicket::where('status', '=', 'Active')->count();
        $utickets = mTicket::where('request_by','=',Auth::user()->department)->where('status', '=','Active')->count();
        return view('widgets.active_widget', [
            'config' => $this->config,
            'tickets' => $tickets,
            'utickets' => $utickets,
        ]);
    }
}
