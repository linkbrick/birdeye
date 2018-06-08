<?php

namespace App\Http\Middleware;

use Closure;

class CheckEntity
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
        if(session('entity', 0) == 0){
            return redirect()->back()->withErrors(["message"=>"Please select an entity before proceed"]);
        }

        return $next($request);
    }
}
