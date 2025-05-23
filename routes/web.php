<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EstablishmentController;
use Illuminate\Support\Facades\Route;


Route::name('index')->get('/', [HomeController::class, 'index']);

Route::prefix('establishments')->name('establishments.')->group(function () {
    Route::get('/create', [EstablishmentController::class, 'create'])->name('create');
    Route::post('/', [EstablishmentController::class, 'store'])->name('store');
    Route::get('/{id}', [EstablishmentController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [EstablishmentController::class, 'edit'])->name('edit');
    Route::put('/{id}', [EstablishmentController::class, 'update'])->name('update');
    Route::delete('/{id}', [EstablishmentController::class, 'destroy'])->name('destroy');
});