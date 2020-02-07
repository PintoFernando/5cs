<?php

namespace sis5cs\Http\Middleware;

use Closure;

class OficialCreditoMiddleware
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
       if(!(auth()->user()->id_rol==3))
        {
            return redirect('oficial/dashboard/');
        }
        return $next($request);
    }
}
