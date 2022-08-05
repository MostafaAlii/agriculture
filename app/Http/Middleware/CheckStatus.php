<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStatus
{

    public function handle(Request $request, Closure $next)
    {

        if (setting()->status === 'open') {
            return $next($request); //
        }

        return redirect('/maintenance'); //
        //return response()->json('Your account is inactive');

    }
}
