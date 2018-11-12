<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserMiddleware
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
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            return $next($request);
        }

        //Users permission
        if ($request->is('users/create')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Crear usuario')) {
                return $next($request);
            }
        }
        if ($request->is('users')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Ver usuario')) {
                return $next($request);
            }
        }

        if ($request->is('users/*/show')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Ver usuario')) {
                return $next($request);
            }
        }

        if ($request->is('users/*/edit')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Editar usuario')) {
                return $next($request);
            }
        }

        if ($request->isMethod('delete')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Borrar usuario')) {
                return $next($request);
            }
        }

        if ($request->isMethod('put')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Editar usuario')) {
                return $next($request);
            }
        }

        flash('No autorizado.')->warning();
        return redirect('/home');
    }
}
