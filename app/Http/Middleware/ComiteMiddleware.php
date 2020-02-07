<?php

namespace sis5cs\Http\Middleware;

use Closure;

class ComiteMiddleware
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
         if(!(auth()->user()->id_rol==8))
        {
            return redirect('comite/dashboard/');
        }
        return $next($request);
    }
}
