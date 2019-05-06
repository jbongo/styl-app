<?php

namespace App\Http\Middleware;

use Closure;

class Annexe5
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
        $user = $request->user();
        if($user && 
           $user->role === 'prospect-plus' && 
           $user->profile_complete === 1 && 
           $user->contract_generate === 1 &&
           $user->bool_annex_5 === 0)
            return $next($request);
        abort(500);
    }
}
