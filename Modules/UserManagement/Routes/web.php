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

use Modules\UserManagement\Http\Controllers\UserManagementController;

Route::prefix('usermanagement')->name('usermanagement.')->group(function() {
    Route::get('/', [UserManagementController::class, 'index'])->name('index');
    Route::post('/', [UserManagementController::class, 'store'])->name('store');
    Route::get('/create', [UserManagementController::class, 'create'])->name('create');
    Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
    Route::get('/edit/{user}', [UserManagementController::class, 'edit'])->name('edit');
    Route::post('/{user}', [UserManagementController::class, 'approve'])->name('approve');
    Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('delete');
});
