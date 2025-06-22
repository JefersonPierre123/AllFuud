<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::name('index')->get('/', [HomeController::class, 'index']);

Route::prefix('establishments')->name('establishments.')->group(function () {
    Route::get('{establishment}/show', [EstablishmentController::class, 'show'])->name('show');
    Route::middleware('auth')->group(function () {
        Route::post('/store', [EstablishmentController::class, 'store'])->name('store');
        Route::put('/{establishment}', [EstablishmentController::class, 'update'])->name('update');
    });
});

Route::middleware('auth')->prefix('products')->name('products.')->group(function () {
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');
    Route::patch('/{product}/deactivate', [ProductController::class, 'deactivate'])->name('deactivate');
    Route::patch('/{product}/reactivate', [ProductController::class, 'reactivate'])->name('reactivate');
    Route::get('/form/create', function () {
        return view('components.product-registration-form', [
            'routeSuffix' => 'store',
            'method' => 'POST',
            'routeParams' => [],
            'product' => null,
        ])->render();
    })->name('form.create');
    Route::get('/form/{productId}', function ($productId) {
        $product = \App\Models\Product::findOrFail($productId);
        return view('components.product-registration-form', [
            'routeSuffix' => 'update',
            'method' => 'PUT',
            'routeParams' => [$product->id],
            'product' => $product,
        ])->render();
    })->name('form.edit');
});

Route::middleware( 'auth' )->prefix('clients')->name('clients.')->group(function () {
    Route::post('/store', [ClientController::class, 'store'])->name('store');
    Route::put('/{client}', [ClientController::class, 'update'])->name('update');
});

Route::middleware('auth')->prefix('addresses')->name('addresses.')->group(function () {
    Route::post('/store', [AddressController::class, 'store'])->name('store');
    Route::put('/{address}', [AddressController::class, 'update'])->name('update');
    Route::get('/form/create', function () {
        return view('components.address-registration-form', [
            'routeSuffix' => 'store',
            'method' => 'POST',
            'routeParams' => [],
            'address' => null,
        ])->render();
    })->name('form.create');
    Route::get('/form/{addressId}', function ($addressId) {
        $address = \App\Models\Address::findOrFail($addressId);
        return view('components.address-registration-form', [
            'routeSuffix' => 'update',
            'method' => 'PUT',
            'routeParams' => [$address->id],
            'address' => $address,
        ])->render();
    })->name('form.edit');
});

Route::middleware( 'auth' )->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store']);

Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/checkout/cart', [CheckoutController::class, 'createCart'])->name('checkout.createCart');

Route::get('/cart', [CheckoutController::class, 'showCart'])->name('cart.index');



