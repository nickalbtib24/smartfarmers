<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;
use Auth;
use Response;
class CheckPermisos
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
        if(Auth::user() === null)
        {
            return response(view('error.insuficientPermissions'));
            
        }
        $acciones = $request->route()->getAction();
        $roles = isset($acciones['roles']) ? $acciones['roles'] : null;

        if(Auth::user()-> tieneAlgunRol($roles)|| !$roles)
        {
            return $next($request);
        }
        return response(view('error.insuficientPermissions'));

    }
}
