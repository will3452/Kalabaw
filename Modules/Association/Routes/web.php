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

use Modules\Association\Http\Controllers\AssociationController;

Route::prefix('association')->name('assoc.')->middleware(['auth'])->group(function() {
    Route::get('/', [AssociationController::class, 'index'])->name('index');
    Route::get('/create', [AssociationController::class, 'create'])->name('create');
    Route::get('/edit/{association}', [AssociationController::class, 'edit'])->name('edit');
    Route::post('/', [AssociationController::class, 'store'])->name('store');
    Route::delete('/{association}', [AssociationController::class, 'destroy'])->name('delete');
    Route::put('/{association}', [AssociationController::class, 'update'])->name('update');
});
