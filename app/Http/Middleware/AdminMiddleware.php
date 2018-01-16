<?php

namespace App\Http\Middleware;

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
        if ($request->session()->has('id') || $request->session()->has('u_id')) {
            return $next($request);
        }

        return redirect('/')->with('error','Unauthorised Access');
    }
}
