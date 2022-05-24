<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('dashboard.admin.auth.login');
    }

    public function store(AdminLoginRequest $request) {
         $login = $request->login;
         $admin = Admin::where('email',$login)->orWhere('phone',$login)->first();
        if ($admin->status == 1){
            if( $request->authenticate()){
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
            }
           return redirect()->back()->withErrors(['email'=>(trans('Admin/auth.failed'))]);
        }else{
            return redirect()->back()->withErrors(['email'=>(trans('Admin/auth.notactive'))]);
            dd($admin->status);
        }
    }


    public function destroy(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
