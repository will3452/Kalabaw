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

use Modules\MapTag\Http\Controllers\MapTagController;

Route::prefix('maptag')->name('maptag.')->group(function() {
    Route::get('/', [MapTagController::class, 'index'])->name('index');
    Route::get('/create', [MapTagController::class, 'create'])->name('create');
});
