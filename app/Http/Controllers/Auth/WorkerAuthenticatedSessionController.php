<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\WorkerLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerAuthenticatedSessionController extends Controller
{

    // public function create() {
    //     return view('front.worker.auth.login');

    // }

    public function store(WorkerLoginRequest $request) {
        if( $request->authenticate()){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::FRONT);
        }
    //    return redirect()->route('worker.login')->withErrors(['email'=>(trans('Admin/auth.failed'))]);
       return redirect()->back()->withErrors(['name'=>(trans('Admin/auth.failed'))]);
    }

    public function destroy(Request $request) {
        Auth::guard('worker')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
