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

use Modules\Fishermen\Http\Controllers\AreaController;
use Modules\Fishermen\Http\Controllers\FishermenController;

Route::prefix('fishermens')->name('fishermen.')->middleware(['auth'])->group(function() {
    Route::get('/', [FishermenController::class, 'index'])->name('index');
    Route::get('/create', [FishermenController::class, 'create'])->name('create');
    Route::post('/', [FishermenController::class, 'store'])->name('store');
    Route::get('/edit/{fishermen}', [FishermenController::class, 'edit'])->name('edit');
    Route::get('/{fishermen}', [FishermenController::class, 'show'])->name('show');
    Route::put('/{fishermen}', [FishermenController::class, 'update'])->name('update');
    Route::delete('/{fishermen}', [FishermenController::class, 'destroy'])->name('delete');
});

Route::prefix('fishermen-area')->name('area.')->middleware(['auth'])->group(function() {
    Route::get('/', [AreaController::class, 'index'])->name('index');
    Route::get('/create', [AreaController::class, 'create'])->name('create');
    Route::post('/', [AreaController::class, 'store'])->name('store');
    Route::get('/{area}', [AreaController::class, 'edit'])->name('edit');
    Route::put('/{area}', [AreaController::class, 'update'])->name('update');
    Route::delete('/{area}', [AreaController::class, 'destroy'])->name('delete');
});
