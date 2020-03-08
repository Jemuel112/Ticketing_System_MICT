<?php

namespace App\Widgets;

use App\mTicket;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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

        if (Auth::user()->department == "Administrator" || Auth::user()->department == "MICT") {
//            $range0 = date('Y-m-d', strtotime(Carbon::now()));
//            $range1 = date('Y-m-d', strtotime(Carbon::now()->firstOfMonth()));
            $range0 = Carbon::now();
            $range1 = Carbon::now()->firstOfMonth();
//            dd($range0." ". $range1);

//            $from = date('2020-01-01');
            $from = date(Carbon::now()->firstOfMonth());

            $to1 =  Carbon::now();
            $to = date( Carbon::now());
//            $encrypted = Crypt::encryptString('Hello world.');
//            $decrypted = Crypt::decryptString($encrypted);
//            dd( $encrypted."(".$decrypted.")");


            $tickets = mTicket::whereBetween('created_at',  [$from, $to])->count();
            $tickets = mTicket::where('status', '=', 'Active')->get()->groupBy('request_by');

        } else {
            $tickets = mTicket::where('request_by', '=', Auth::user()->department)->where('status', '=', 'Active')->get();
        }
//        dd($tickets);
        return view('widgets.active_table', [
            'config' => $this->config,
            'tickets' => $tickets,
        ]);
    }
}
