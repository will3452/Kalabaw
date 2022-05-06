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

use Modules\Barangay\Http\Controllers\BarangayController;

Route::prefix('barangay')->name('barangay.')->group(function() {
    Route::get('/', [BarangayController::class, 'index'])->name('index');
    Route::get('/create', [BarangayController::class, 'create'])->name('create');
    Route::post('/', [BarangayController::class, 'store'])->name('store');
    Route::get('/edit/{barangay}', [BarangayController::class, 'edit'])->name('edit');
    Route::delete('/{barangay}', [BarangayController::class, 'destroy'])->name('delete');
    Route::put('/{barangay}', [BarangayController::class, 'update'])->name('update');
});
