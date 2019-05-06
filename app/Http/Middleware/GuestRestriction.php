<?php

namespace App\Http\Middleware;
//use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

use Closure;

class GuestRestriction
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    //protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    /*public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }*/

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard('guestusers')->check()) {
            return redirect()->route('guestusers.home');
        }
        return $next($request);
    }
}
