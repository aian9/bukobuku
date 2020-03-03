<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Ceklogin
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
        if (Auth::user()->tipe_akun==1) {
            echo "murid";
        }else if(Auth::user()->tipe_akun==2){
            echo "guru";
        }else{
            echo "selain guru dan murid";
        }


        //return $next($request);
    }
}
