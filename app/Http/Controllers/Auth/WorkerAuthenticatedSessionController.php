<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\WorkerLoginRequest;
use App\Models\Worker;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerAuthenticatedSessionController extends Controller
{
    public function store(WorkerLoginRequest $request) {
        $login = $request->login;
        $worker = Worker::where('email',$login)->orWhere('phone',$login)->first();
        if($worker){
            if($worker->status == 1){
                if( $request->authenticate()){
                    $request->session()->regenerate();
                    return redirect()->intended(RouteServiceProvider::FRONT);
                }
                else{
                    return redirect()->back()->withErrors(['login'=>(trans('Admin/auth.failed'))]);
                }
            }else{
                return redirect()->back()->withErrors(['login'=>(trans('Admin/auth.notactive'))]);
            }
        }else{
            return redirect()->back()->withErrors(['login'=>(trans('Admin/auth.failed'))]);
        }


        // if ($worker && $worker->status == 1){
        //     if( $request->authenticate()){
        //         $request->session()->regenerate();
        //         return redirect()->intended(RouteServiceProvider::FRONT);
        //     }else{
        //         return redirect()->back()->withErrors(['name'=>(trans('Admin/auth.failed'))]);
        //     }
        // }else{
        //     // dd($worker->status);
        //     return redirect()->back()->withErrors(['login'=>(trans('Admin/auth.notactive'))]);
        // }



        // if ($worker->status == 1){
        //     if( $request->authenticate()){
        //         $request->session()->regenerate();
        //         return redirect()->intended(RouteServiceProvider::FRONT);
        //     }
        //    return redirect()->back()->withErrors(['name'=>(trans('Admin/auth.failed'))]);
        // }elseif($worker->status == 0){
        //     return redirect()->back()->withErrors(['login'=>(trans('Admin/auth.notactive'))]);
        // }else{
        //     return redirect()->back()->withErrors(['login'=>(trans('Admin/auth.notactive'))]);
        // }
        // dd($request->all());

    }

    public function destroy(Request $request) {
        Auth::guard('worker')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
