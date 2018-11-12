<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class RoleMiddleware
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

        //roles permission
        if ($request->is('roles/create')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Crear rol')) {
                return $next($request);
            }
        }
        if ($request->is('roles')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Ver rol')) {
                return $next($request);
            }
        }

        if ($request->isMethod('delete')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Borrar rol')) {
                return $next($request);
            }
        }

        if ($request->isMethod('put')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Editar rol')) {
                return $next($request);
            }
        }

        flash('No autorizado.')->warning();
        return redirect('/home');
    }
}
