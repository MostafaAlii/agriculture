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
    public function create() {
        return view('dashboard.admin.auth.login');
    }

    public function store(AdminLoginRequest $request) {
         $login = $request->login;
         $admin = Admin::where('email',$login)->orWhere('phone',$login)->first();
         if($admin){
                if ($admin->status == 1){
                    if( $request->authenticate()){
                        $request->session()->regenerate();
                        return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
                    }
                    else{
                        return redirect()->back()->withErrors(['name'=>(trans('Admin/auth.failed'))]);
                    }
                }else{
                    return redirect()->back()->withErrors(['email'=>(trans('Admin/auth.notactive'))]);
                }
        }else{
            return redirect()->back()->withErrors(['name'=>(trans('Admin/auth.failed'))]);
        }
    }

    public function destroy(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


}
