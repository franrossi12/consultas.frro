<?php

namespace App\Http\Middleware;

use Closure;

class IsPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $perfil
     * @return mixed
     */
    public function handle($request, Closure $next, $perfil)
    {
        if (auth()->user()->isPerfil($perfil)) {
            return $next($request);
        } else {
            return route('auth.login');
        }
    }
}
