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

use Modules\Inventory\Http\Controllers\InventoryController;
use Modules\Inventory\Http\Controllers\ItemsController;
use Modules\Inventory\Http\Controllers\UnitOfMeasurementController;

Route::prefix('inventory')->name('inventory.')->group(function() {
    Route::get('/', [InventoryController::class, 'index'])->name('index');
    Route::get('/create', [InventoryController::class, 'create'])->name('create');
    Route::post('/', [InventoryController::class, 'store'])->name('store');
    Route::get('/{inventory}', [InventoryController::class, 'edit'])->name('edit');
    Route::put('/{inventory}', [InventoryController::class, 'update'])->name('update');
    Route::delete('/{inventory}', [InventoryController::class, 'destroy'])->name('delete');
});

Route::prefix('inventory-items')->name('item.')->group(function () {
    Route::get('/', [ItemsController::class, 'index'])->name('index');
    Route::get('/create', [ItemsController::class, 'create'])->name('create');
    Route::post('/', [ItemsController::class, 'store'])->name('store');
    Route::get('/{item}', [ItemsController::class, 'edit'])->name('edit');
    Route::put('/{item}', [ItemsController::class, 'update'])->name('update');
    Route::delete('/{item}', [ItemsController::class, 'destroy'])->name('delete');
});

Route::prefix('unit-of-measurement')->name('unit.')->group(function () {
    Route::get('/', [UnitOfMeasurementController::class, 'index'])->name('index');
    Route::get('/create', [UnitOfMeasurementController::class, 'create'])->name('create');
    Route::post('/', [UnitOfMeasurementController::class, 'store'])->name('store');
    Route::get('/{unit}', [UnitOfMeasurementController::class, 'edit'])->name('edit');
    Route::put('/{unit}', [UnitOfMeasurementController::class, 'update'])->name('update');
    Route::delete('/{unit}', [UnitOfMeasurementController::class, 'destroy'])->name('delete');
});
