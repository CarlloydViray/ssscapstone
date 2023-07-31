<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SignUp;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('loginPage');
});

Route::post('login', [UserAuth::class, 'login']);
Route::view('debug', 'debug');
Route::view('chairMainPage', 'chair.chairMainPage');
Route::view('misMainPage', 'mis.misMainPage');

Route::get('/signup', function () {

    $departments = DB::table('departments')->get(); // Fetch all departments from the database

    return view('signupPage', ['departments' => $departments]);
});

Route::post('signup', [SignUp::class, 'createAcc']);

Route::get('/', function () {
    if (session()->has('user_id')) {
        $user_id = session('user_id');
        $user  = DB::select('SELECT * FROM users WHERE user_id = ?', [$user_id]);

        if (!empty($user) && $user[0]->user_type == 'mis') {
            return redirect('misMainPage');
        }
        if (!empty($user) && $user[0]->user_type == 'chair') {
            return redirect('chairMainPage');
        }
    }
    return view('loginPage');
});

Route::get('/logout', function () {
    if (session()->has('user_id')) {
        session()->pull('user_id');
    }
    return redirect('/')->with('success', 'Log out successful');
});
