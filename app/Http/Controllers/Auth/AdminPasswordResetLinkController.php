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
class AdminPasswordResetLinkController extends Controller
{

    public function create()
    {
        return view('dashboard.admin.auth.admin-forget');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
        ]);
        $admin = DB::table('admins')->where('email', '=', $request->email)
        ->first();
        //Check if the user exists
        if ($admin == null) {
            return redirect()->back()->withErrors(['email' => trans('Admin does not exist')]);
        }
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
          ]);
        Mail::send('dashboard.admin.auth.adminforgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect()->back()->with('status', __('Website/home.sendresetsms'));
    }

}
