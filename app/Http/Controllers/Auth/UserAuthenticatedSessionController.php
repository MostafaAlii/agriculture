<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('front.user.auth.login');

    }

    public function store(UserLoginRequest $request) {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::FRONT);
        // return $request;
        // dd($request->email);
    }

    public function destroy(Request $request) {
        Auth::guard('vendor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
