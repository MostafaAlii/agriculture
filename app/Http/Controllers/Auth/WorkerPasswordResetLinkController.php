<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Cartalyst\Support\Validator;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Mail;
class WorkerPasswordResetLinkController extends Controller
{

    public function create()
    {
        // return view('auth.forgot-password');
        return view('front.user.auth.worker-forget');
    }



    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:workers',
        ]);
        $worker = DB::table('workers')->where('email', '=', $request->email)
        ->first();
        //Check if the user exists
        if ($worker == null) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
          ]);
        Mail::send('front.user.auth.farmerforgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect()->back()->with('status', __('Website/home.sendresetsms'));
    }

}
