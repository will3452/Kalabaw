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

use Modules\Farmer\Http\Controllers\CropController;
use Modules\Farmer\Http\Controllers\FarmerController;
use Modules\Farmer\Http\Controllers\LivestockOrPoultryController;
use Modules\Farmer\Http\Controllers\MachineAndEquipmentController;
use Modules\Farmer\Http\Controllers\TreeController;

Route::prefix('farmer')->name('farmer.')->group(function() {
    Route::get('/printable/{farmer}', [FarmerController::class, 'generatePrintable'])->name('print');
    Route::get('/', [FarmerController::class, 'index'])->name('index');
    Route::get('/create', [FarmerController::class, 'create'])->name('create');
    Route::post('/', [FarmerController::class, 'store'])->name('store');
    Route::get('/{farmer}', [FarmerController::class, 'show'])->name('show');
    Route::get('/edit/{farmer}', [FarmerController::class, 'edit'])->name('edit');
    Route::put('/{farmer}', [FarmerController::class, 'update'])->name('update');
    Route::delete('/{farmer}', [FarmerController::class, 'destroy'])->name('delete');
});

Route::prefix('crop')->name('crop.')->group(function () {
    Route::get('/', [CropController::class, 'index'])->name('index');
    Route::get('/create', [CropController::class, 'create'])->name('create');
    Route::post('/', [CropController::class, 'store'])->name('store');
    Route::get('/{crop}', [CropController::class, 'edit'])->name('edit');
    Route::put('/{crop}', [CropController::class, 'update'])->name('update');
    Route::delete('/{crop}', [CropController::class, 'destroy'])->name('delete');
});

Route::prefix('machine-and-equipment')->name('mae.')->group(function () {
    Route::get('/', [MachineAndEquipmentController::class, 'index'])->name('index');
    Route::get('/create', [MachineAndEquipmentController::class, 'create'])->name('create');
    Route::post('/', [MachineAndEquipmentController::class, 'store'])->name('store');
    Route::get('/{mae}', [MachineAndEquipmentController::class, 'edit'])->name('edit');
    Route::put('/{mae}', [MachineAndEquipmentController::class, 'update'])->name('update');
    Route::delete('/{mae}', [MachineAndEquipmentController::class, 'destroy'])->name('delete');
});

Route::prefix('tree')->name('tree.')->group(function () {
    Route::get('/', [TreeController::class, 'index'])->name('index');
    Route::get('/create', [TreeController::class, 'create'])->name('create');
    Route::post('/', [TreeController::class, 'store'])->name('store');
    Route::get('/{tree}', [TreeController::class, 'edit'])->name('edit');
    Route::put('/{tree}', [TreeController::class, 'update'])->name('update');
    Route::delete('/{tree}', [TreeController::class, 'destroy'])->name('delete');
});

Route::prefix('livestock-or-poultry')->name('lop.')->group(function () {
    Route::get('/', [LivestockOrPoultryController::class, 'index'])->name('index');
    Route::get('/create', [LivestockOrPoultryController::class, 'create'])->name('create');
    Route::post('/', [LivestockOrPoultryController::class, 'store'])->name('store');
    Route::get('/{lop}', [LivestockOrPoultryController::class, 'edit'])->name('edit');
    Route::put('/{lop}', [LivestockOrPoultryController::class, 'update'])->name('update');
    Route::delete('/{lop}', [LivestockOrPoultryController::class, 'destroy'])->name('delete');
});
