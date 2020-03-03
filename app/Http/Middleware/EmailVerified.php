<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class EmailVerified
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
        if (\Auth::user()->cekStatus(User::STATUS_EMAIL_ACTIVATED))
            return $next($request);
        return redirect(route('verification.email'));
    }
}
