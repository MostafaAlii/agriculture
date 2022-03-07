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
    public function handle(Request $request, Closure $next)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }

            // switch ($guard) {
            //     case 'vendor':
            //         if (Auth::guard($guard)->check()) {
            //             return redirect(RouteServiceProvider::FRONT);
            //         }
            //         break;

            //     default:
            //         if (Auth::guard($guard)->check()) {
            //             return redirect(RouteServiceProvider::HOME);
            //         }
            //         break;
            // }
        // }

         if (auth('web')->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
         if (auth('vendor')->check()) {
                return redirect(RouteServiceProvider::FRONT);
            }

        return $next($request);
    }
}
