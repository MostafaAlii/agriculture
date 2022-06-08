<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FarmerRegisterRequest;
use App\Models\Farmer;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Notification;
class RegisteredFarmerController extends Controller
{

    public function store(FarmerRegisterRequest $request)
    {
        $requestData = $request->validated();
        $farmer = Farmer::create([
            'firstname'    => $request->firstname,
            'lastname'     => $request->lastname,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
        ]);
        // Notification::send($farmer, new \App\Notifications\NewFarmer($farmer));
        event(new Registered($farmer));

        auth('web')->login($farmer);

        // return redirect(RouteServiceProvider::FRONT);
        return redirect()->route('front');
    }
}
