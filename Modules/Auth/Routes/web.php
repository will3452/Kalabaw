<?php

use Modules\Auth\Http\Controllers\AuthController;

Route::prefix('auth')->name('auth.')->middleware(['guest'])->group(function() {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::prefix('auth')->name('auth.')->middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('email/verify', function () {
    return view('auth::verification_notice');
})->name('verification.notice');
Route::get('email/verify/{id}/{hash}', function (Request $request) {
    auth()->user()->markEmailAsVerified();

    return redirect('/dashboard');
})->name('verification.verify');
Route::post('email/resend', function () {
    auth()->user()->sendEmailVerificationNotification();
    return 'email verification link has been sent, please check your email!';
})->name('verification.resend');
