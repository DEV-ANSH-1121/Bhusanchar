<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\CareerApplicationController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactEnquiryController;
use App\Http\Controllers\FarmerHelpCardController;
use App\Http\Controllers\StockPointApplicationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'frontend.pages.home')->name('home');

Route::prefix('about')->name('about.')->group(function () {
    Route::view('/', 'frontend.pages.about.index')->name('index');
    Route::view('/mission', 'frontend.pages.about.mission')->name('mission');
    Route::view('/team', 'frontend.pages.about.team')->name('team');
    Route::view('/investor', 'frontend.pages.about.investor')->name('investor');
});

Route::view('/products', 'frontend.pages.products')->name('products');

Route::prefix('services')->name('services.')->group(function () {
    Route::view('/', 'frontend.pages.services.index')->name('index');
    Route::view('/farmer-help-card', 'frontend.pages.services.farmer-help-card')->name('farmer-help-card');
    Route::post('/farmer-help-card', [FarmerHelpCardController::class, 'store'])->middleware('throttle:10,1')->name('farmer-help-card.store');
    Route::view('/find-stock-point', 'frontend.pages.services.find-stock-point')->name('find-stock-point');
    Route::view('/network', 'frontend.pages.services.network')->name('network');
    Route::view('/knowledge', 'frontend.pages.services.knowledge')->name('knowledge');
});

Route::view('/resource/gallery', 'frontend.pages.resource.gallery')->name('resource.gallery');

Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::post('/careers/applications', [CareerApplicationController::class, 'store'])->middleware('throttle:10,1')->name('careers.apply');

Route::prefix('partner')->name('partner.')->group(function () {
    Route::view('/', 'frontend.pages.partner.index')->name('index');
    Route::post('/', [StockPointApplicationController::class, 'store'])->middleware('throttle:10,1')->name('store');
});

Route::view('/contact', 'frontend.pages.contact')->name('contact');
Route::post('/contact', [ContactEnquiryController::class, 'store'])->middleware('throttle:10,1')->name('contact.store');

Route::view('/admin', 'frontend.pages.admin')->name('admin');

Route::get('products/{product}/image', [ProductController::class, 'image'])->name('products.image');
