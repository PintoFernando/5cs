<?php

namespace sis5cs\Http\Middleware;

use Closure;

class AdminMiddleware
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
       
        if(!(auth()->user()->id_rol==1))
        {
            return redirect('/dashboard/');
        }
        return $next($request);
    }
}
