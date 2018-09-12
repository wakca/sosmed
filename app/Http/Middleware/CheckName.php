<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class CheckName
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
        $name = Auth::user()->name;
        if(isset($name)){
            return $next($request);
        }
        Session::flash('message','Terima Kasih sudah bergabung bersama dengan klipaa.com,  ajak orang satu desa dan kelurahan untuk bergabung, di klipaa anda akan otomatis berteman secara menyenangkan !');
        Session::flash('alert-class','alert-warning');
        return redirect()->route('profile.edit');
    }
}
