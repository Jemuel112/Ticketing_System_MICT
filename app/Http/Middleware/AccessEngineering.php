<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessEngineering
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->department == 'Engineering') {
            return $next($request);
        }
        return redirect()->back();

    }
}
