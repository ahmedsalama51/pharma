<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Routing\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfNotAdmin
{
/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @param  string|null  $guard
 * @return mixed
 */
public function handle($request, Closure $next, $guard = null)
{
    if (!Auth::guard($guard)->check()) {
        return redirect('/');
    }

        if (Auth::user()->isAdmin())
        {
            return $next($request);

        }
        else{
        	return redirect('/');
        }
}


}