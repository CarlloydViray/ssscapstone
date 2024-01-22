<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class ForgotPassword extends Controller
{
    public  function forgotpassword()
    {
        return view('ForgotPassword');
    }


    public function forgotpasswordpost(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email|exists:users,user_email',
        ], [
            'user_email.exists' => 'The specified email does not exist in our records.',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->user_email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("resetpassword.forget-password", ['token' => $token], function ($message) use ($request) {
            $message->to($request->user_email);
            $message->subject("Reset Password");
        });

        return redirect()->to('/')->with("success", "We have sent the email to reset password");
    }

    public function  resetpassword($token)
    {
        return view('new_password', compact('token'));
    }

    public function  resetpasswordpost(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'password' => 'required|min:8',
            'password2' => 'required|same:password',
        ]);

        $updatedPassword =  DB::table('password_resets')->where([
            'email' => $request->user_email,
            'token' => $request->token,
        ])->first();

        if (!$updatedPassword) {
            return redirect()->to(route('forgot.password'))->with('error', 'Email not found on rest password list');
        }


        DB::table('users')->where('user_email', $request->user_email)->update([
            'user_password' => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where('email', $request->user_email)->delete();

        return redirect()->to('/')->with('success', 'Password Reset Success');
    }
}
