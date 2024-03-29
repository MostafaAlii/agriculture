<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Notification;

class RegisteredUserController extends Controller
{
    // public function create()
    // {
    //     return view('auth.register');
    // }
    public function store(UserRegisterRequest $request)
    {
        // dd($request->all());
        $requestData = $request->validated();
        $user = User::create([
            'firstname'    => $request->firstname,
            'lastname'     => $request->lastname,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
        ]);
        //Notification::send($user, new \App\Notifications\NewUser($user));
        //event(new Registered($user));

        auth('vendor')->login($user);

        // return redirect(RouteServiceProvider::FRONT);
        return redirect()->route('front');
    }
}