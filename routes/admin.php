<?php

use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\CareerApplicationController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\CropController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FarmerHelpCardController;
use App\Http\Controllers\Admin\PackagingController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StockPointApplicationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('products/{product}/image', [ProductController::class, 'image'])->name('products.image');
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('crops', CropController::class)->except(['show']);
    Route::resource('packagings', PackagingController::class)->except(['show']);
    Route::resource('enquiries/contacts', ContactEnquiryController::class)
        ->parameters(['contacts' => 'contactEnquiry'])
        ->names('contact-enquiries');
    Route::patch('enquiries/contacts/{contactEnquiry}/status', [ContactEnquiryController::class, 'updateStatus'])->name('contact-enquiries.status');
    Route::resource('enquiries/farmer-help-cards', FarmerHelpCardController::class)
        ->parameters(['farmer-help-cards' => 'farmerHelpCard'])
        ->names('farmer-help-cards');
    Route::patch('enquiries/farmer-help-cards/{farmerHelpCard}/status', [FarmerHelpCardController::class, 'updateStatus'])->name('farmer-help-cards.status');
    Route::resource('enquiries/stock-points', StockPointApplicationController::class)
        ->parameters(['stock-points' => 'stockPointApplication'])
        ->names('stock-point-applications');
    Route::patch('enquiries/stock-points/{stockPointApplication}/status', [StockPointApplicationController::class, 'updateStatus'])->name('stock-point-applications.status');
    Route::get('enquiries/career-applications/{careerApplication}/resume', [CareerApplicationController::class, 'resume'])->name('career-applications.resume');
    Route::resource('enquiries/career-applications', CareerApplicationController::class)
        ->parameters(['career-applications' => 'careerApplication'])
        ->names('career-applications');
    Route::patch('enquiries/career-applications/{careerApplication}/status', [CareerApplicationController::class, 'updateStatus'])->name('career-applications.status');
    Route::resource('careers', CareerController::class)->except(['show']);
});
