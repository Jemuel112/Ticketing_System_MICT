<?php

namespace App\Widgets;

use App\mTicket;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;

class ActiveTable extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    public $config = [
    ];

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
        //
        if(Auth::user()->department == "Administrator" || Auth::user()->department =="MICT"){
        $tickets1 = mTicket::where('status', '=', 'Active')->paginate(5);
        }else{
        $tickets1 = mTicket::where('request_by','=', Auth::user()->department)->where('status', '=','Active')->paginate(5);
        }
        return view('widgets.active_table', [
            'config' => $this->config,
            'tickets1' => $tickets1,
        ]);
    }
}
