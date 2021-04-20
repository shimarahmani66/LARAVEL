<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin
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
        // echo $request->ip();
        // dd('hi');
        if(Auth::check()){
            $role=Auth::user()->role;
            if($role=='admin'){
                return $next($request);
            }
            else{
                abort(404);
            }
        }
        else{
            abort(404);
        }
        
    }
}
