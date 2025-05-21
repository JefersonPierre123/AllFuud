<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


    Route::name('index')->get('/', [HomeController::class, 'index']);
