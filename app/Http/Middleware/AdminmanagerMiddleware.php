<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class AdminmanagerMiddleware
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
        if($request->user()->roles=='Manager' or $request->user()->roles=='Admin')
        {
            return $next($request);
        }      
        return redirect('/')->withSuccess('No tienes permiso para esta acción!!');
    }
}
