<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function (Request $request) {

    if (
        $request->email == 'admin@gmail.com' &&
        $request->password == '12345'
    ) {

        session([
            'login_success' => true,
            'email' => $request->email
        ]);

        return redirect('/users');
    }

    return back()->with('error', 'Email atau Passwordnya salah');
});

Route::resource('users', UserController::class);