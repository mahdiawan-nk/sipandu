<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class APISessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role = $request->session()->get('role');
        $iduser = $request->session()->get('uuid');
        $idposyandu = $request->session()->get('posyandu');

        $request->merge(compact('role', 'iduser','idposyandu'));
        return $next($request);
    }
}
