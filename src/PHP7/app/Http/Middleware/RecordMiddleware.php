<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RecordMiddleware
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

        //records permission
        if ($request->is('records/create')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Crear medida')) {
                return $next($request);
            }
        }
        if ($request->is('records')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Ver medida')) {
                return $next($request);
            }
        }

        if ($request->is('records/list')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Ver medida')) {
                return $next($request);
            }
        }

        if ($request->is('records/*/show')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Ver medida')) {
                return $next($request);
            }
        }

        if ($request->isMethod('delete')) {
            if (Auth::user() && Auth::user()->hasPermissionTo('Borrar medida')) {
                return $next($request);
            }
        }
        flash('No autorizado.')->warning();
        return redirect('/home');
    }
}
