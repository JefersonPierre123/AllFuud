<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::name('index')->get('/', [HomeController::class, 'index']);

Route::prefix('establishments')->name('establishments.')->group(function () {
    Route::get('/create', [EstablishmentController::class, 'create'])->name('create');
    Route::post('/store', [EstablishmentController::class, 'store'])->name('store');
    Route::get('/{id}', [EstablishmentController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [EstablishmentController::class, 'edit'])->name('edit');
    Route::put('/{id}', [EstablishmentController::class, 'update'])->name('update');
    Route::delete('/{id}', [EstablishmentController::class, 'destroy'])->name('destroy');
});

Route::prefix('clients')->name('clients.')->group(function () {
    Route::get('/create', [ClientController::class, 'create'])->name('create');
    Route::post('/store', [ClientController::class, 'store'])->name('store');
    Route::get('/{id}', [ClientController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ClientController::class, 'update'])->name('update');
    Route::delete('/{id}', [ClientController::class, 'destroy'])->name('destroy');
});

Route::prefix('addresses')->name('addresses.')->group(function () {
    Route::get('/create', [AddressController::class, 'create'])->name('create');
    Route::post('/store', [AddressController::class, 'store'])->name('store');
    Route::get('/{id}', [AddressController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AddressController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AddressController::class, 'update'])->name('update');
    Route::delete('/{id}', [AddressController::class, 'destroy'])->name('destroy');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');