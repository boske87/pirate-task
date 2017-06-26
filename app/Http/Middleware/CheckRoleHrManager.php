<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleHrManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check() || !Auth::user()->hasRole('manager')) {
            return redirect('/')->with([
                'flash_message' => 'You need to be logged in as Hr manager.',
                'flash_message_type' => 'danger'
            ]);
        }

        return $next($request);
    }
}
