<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/auth'));

Route::get('/reports', [ReportController::class, 'index'])->name('report');
Route::get('/generate-report', [ReportController::class, 'generate']);

Route::get('/dashboard', DashboardController::class)->name('home');
Route::redirect('/login', '/auth')->name('login');
