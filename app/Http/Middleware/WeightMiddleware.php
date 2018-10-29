<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class WeightMiddleware
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

        //Weights permission
        if ($request->is('weights/create')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Crear peso')) {
                return $next($request);
            }
        }
        if ($request->is('weights')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Ver peso')) {
                return $next($request);
            }
        }

        if ($request->is('weights/*/show')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Ver peso')) {
                return $next($request);
            }
        }

        if ($request->isMethod('delete')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Borrar peso')) {
                return $next($request);
            }
        }

        if ($request->isMethod('put')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Editar peso')) {
                return $next($request);
            }
        }

        flash('No autorizado.')->warning();
        return redirect('/home');
    }
}
