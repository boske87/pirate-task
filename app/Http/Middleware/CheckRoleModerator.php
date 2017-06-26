<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleModerator
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
        // login user if passed param login_user
        if($request->input('login_user')) {
            Auth::loginUsingId($request->input('login_user'));
        }


        if (!Auth::guard($guard)->check() || !Auth::user()->hasRole('moderator')) {
            return redirect('/')->with([
                'flash_message' => 'You need to be logged in as Job board moderator.',
                'flash_message_type' => 'danger'
            ]);
        }


        return $next($request);
    }
}
