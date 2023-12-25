<?php

use App\Http\Controllers\Tenant\CartController;
use App\Http\Controllers\Tenant\CheckoutController;
use App\Http\Controllers\Tenant\MenuController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'tenant.', 'prefix' => 'table/{table_number}'], function () {
    Route::get('menu', [MenuController::class, 'index'])->name('home');
    Route::get('items', [MenuController::class, 'list'])->name('menu.items');
    Route::get('items/{product_id}', [MenuController::class, 'show'])->name('menu.items.show');
    Route::resource('cart', CartController::class)->except(['create', 'edit', 'show']);
    Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
});


