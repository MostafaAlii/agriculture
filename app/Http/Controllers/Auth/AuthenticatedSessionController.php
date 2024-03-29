<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('dashboard.farmer.auth.login');
    }

    public function store(LoginRequest $request) {
        // dd($request->all());
        if( $request->authenticate()){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::FRONT);
            // return redirect()->intended(RouteServiceProvider::FARMER_DASHBOARD );
        }
       return redirect()->back()->withErrors(['name'=>(trans('Admin/auth.failed'))]);
    }

    public function destroy(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
