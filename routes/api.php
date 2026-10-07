<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('products', [ProductController::class, 'index'])->name('api.products.index');
