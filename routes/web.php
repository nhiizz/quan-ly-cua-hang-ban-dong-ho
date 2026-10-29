<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\OrderDetailController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PaymentController;


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::resource('categories',CategoryController::class);

    Route::resource('brands',BrandController::class);

    Route::resource('products',ProductController::class);

    Route::resource('inventories',InventoryController::class);

    Route::resource('accounts', AccountController::class);

    Route::resource('orders', OrdersController::class);

    Route::get('/orders/{order}/products/create', [OrderDetailController::class, 'create'])
    ->name('orders.products.create');

    Route::post('/orders/{order}/products', [OrderDetailController::class, 'store'])
    ->name('orders.products.store');

    Route::resource('payments', PaymentController::class);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
