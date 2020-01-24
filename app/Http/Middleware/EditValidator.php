<?php

namespace App\Http\Middleware;

use App\mTicket;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class EditValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ticket = $request->MICT_Ticket;
        $ticket = mTicket::where('id', '=', $ticket)->first();
        if (Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT') {
            return $next($request);
        }elseif($ticket->request_by == Auth::user()->department){
            return $next($request);
        }
        return redirect()->back();
    }
}
