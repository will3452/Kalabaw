<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Bin\Http\Controllers\BinController;

Route::prefix('bin')->name('bin.')->group(function() {
    Route::get('/', [BinController::class, 'index'])->name('index');
    Route::post('/restore', [BinController::class, 'restore'])->name('restore');
});
