<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessAM
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
        if (Auth::user()->department == 'Administrator') {
            return $next($request);
        }
        elseif (Auth::user()->department == 'MICT'){
            return $next($request);
        }
        return redirect('/');
    }
}
