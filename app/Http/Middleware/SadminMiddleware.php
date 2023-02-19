<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SadminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->roles=='S.Admin')
        {
            return $next($request);
        }
        return redirect('/')->withSuccess('No tienes permiso para esta acción!!');
        return $next($request);
    }
}
