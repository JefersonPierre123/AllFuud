<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::name('index')->get('/', [HomeController::class, 'index']);

Route::middleware( 'auth' )->prefix('establishments')->name('establishments.')->group(function () {
    Route::post('/store', [EstablishmentController::class, 'store'])->name('store');
    Route::put('/{id}', [EstablishmentController::class, 'update'])->name('update');
    Route::delete('/{id}', [EstablishmentController::class, 'destroy'])->name('destroy');
});

Route::get('establishments/{id}/show', [EstablishmentController::class, 'show'])->name('establishments.show');

Route::middleware( 'auth' )->prefix('clients')->name('clients.')->group(function () {
    Route::post('/store', [ClientController::class, 'store'])->name('store');
    Route::put('/{id}', [ClientController::class, 'update'])->name('update');
    Route::delete('/{id}', [ClientController::class, 'destroy'])->name('destroy');
});

Route::middleware( 'auth' )->prefix('addresses')->name('addresses.')->group(function () {
    Route::post('/store', [AddressController::class, 'store'])->name('store');
    Route::put('/{id}', [AddressController::class, 'update'])->name('update');
    Route::delete('/{id}', [AddressController::class, 'destroy'])->name('destroy');
});



Route::middleware( 'auth' )->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/{id}', [ProfileController::class, 'updateProfile'])->name('update');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');