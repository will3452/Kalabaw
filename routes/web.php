<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/auth'));

Route::get('/dashboard', DashboardController::class)->name('home');
Route::redirect('/login', '/auth')->name('login');
