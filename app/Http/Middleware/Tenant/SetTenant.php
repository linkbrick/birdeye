<?php

namespace App\Http\Middleware\Tenant;

use Closure;

class SetTenant
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
        dd(session('tenant'));
        return $next($request);
    }
}
