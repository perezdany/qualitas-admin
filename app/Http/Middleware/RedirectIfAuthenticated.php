<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                //ON A DEUX TYPE D'AUTHENTIFICATION A NE PAS OUBLIER
                if($guard === 'admin')// si notre guardien d'authentification est celui de l'admin
                {
                    return redirect()->route('dash');
                }

                if($guard === 'user')// si notre guardien d'authentification est celui de l'admin
                {
                    return redirect()->route('welcome');
                }
                //return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
