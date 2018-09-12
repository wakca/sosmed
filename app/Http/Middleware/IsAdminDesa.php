<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class IsAdminDesa
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
        //1 for Regular User, 2 for 
        if (Auth::check() && Auth::user()->level == 2 )
        {
            return $next($request);
        }
    
        return redirect()->back();
    }
}
