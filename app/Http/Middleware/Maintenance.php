<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class Maintenance
{

    public function handle(Request $request, Closure $next)
    {
        if (setting()->status == 'close') {
            return redirect('maintenance');
        } else {
            return $next($request);

        }

    }
}
