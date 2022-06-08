<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRegisterRequest;
use App\Http\Requests\Dashboard\WorkerRegisterRequest;
use App\Models\User;
use App\Models\Worker;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Notification;

class RegisteredWorkerController extends Controller
{
    // public function create()
    // {
    //     return view('auth.register');
    // }
    public function store(WorkerRegisterRequest $request)
    {
        // dd($request->all());
        $requestData = $request->validated();
        $worker = Worker::create([
            'firstname'    => $request->firstname,
            'lastname'     => $request->lastname,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
        ]);
        // Notification::send($worker, new \App\Notifications\NewWorker($worker));
        event(new Registered($worker));

        auth('worker')->login($worker);

        // return redirect(RouteServiceProvider::FRONT);
        return redirect()->route('front');
    }
}
