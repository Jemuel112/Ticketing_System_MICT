<?php

namespace App\Http\Middleware;

use App\Department;
use App\Endorsement;
use Closure;
use Illuminate\Support\Facades\Auth;

class Endorsment
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd($request->Endorsement);
        if (Auth::user()->department == "Administrator" || Auth::user()->department == "MICT") {
            return $next($request);
        } else {
            $user = Auth::user()->id;
            $endorsement = Endorsement::findOrFail($request->Endorsement);
            $dept = Department::select('id')->where('dept_name', Auth::user()->department)->first();
            $assign = explode(', ', $endorsement->assigned_to_id);
            $depts = explode(', ', $endorsement->assigned_dept_id);
            if (in_array($user, $assign)) {
                return $next($request);
            } elseif (in_array($dept->id, $depts)) {
                return $next($request);
            } elseif ($endorsement->created_by_id == Auth::user()->id) {
                return $next($request);
            }
        }
        return redirect()->back();
    }
}
