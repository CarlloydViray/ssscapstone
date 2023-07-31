<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAuth extends Controller
{
    public function login(Request $req)
    {

        $this->validate($req, [
            'username' => 'required',
            'password' => 'required',

        ]);
        $username = $req->input('username');
        $password = $req->input('password');

        $user = DB::table('users')->where('username', $username)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                if ($user->user_type === 'mis') {
                    $req->session()->put('user_id', $user->user_id);
                    return redirect('misMainPage')->with('success', 'Log in successful');
                } elseif ($user->user_type === 'chair') {
                    $req->session()->put('user_id', $user->user_id);
                    return redirect('chairMainPage')->with('success', 'Log in successful');
                } else {
                    // Role not specified or invalid
                    return redirect('/')->with('error', 'Authentication successful! Invalid role specified!');
                }
            } else {
                // Password does not match
                return redirect('/')->with('error', 'Incorrect Username or Password');
            }
        } else {
            // User record does not exist
            return redirect('/')->with('error', 'User does not exist');
        }
    }
}
