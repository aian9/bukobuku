<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class ProfilLengkap
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
        if (Auth::user()->cekStatus(User::STATUS_VERIFIED_PROFILE))
            return $next($request);
        return redirect(route('user.dashboard.edit_profile'));
    }
}
