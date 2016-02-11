<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Redirect;
use Request;
use Role;

class SuMiddleware
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
		if(Auth::user()->authorize() < 1)
		{
			return Redirect::intended('/login');
		}
		
        return $next($request);
    }
}
