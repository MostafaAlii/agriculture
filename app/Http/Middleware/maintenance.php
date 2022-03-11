<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class maintenance
{

    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::orderby('id','desc')->first();
        if ($setting->status === 'close') {
            return redirect('maintenance');
        } else {
            return $next($request);

        }

    }
}
