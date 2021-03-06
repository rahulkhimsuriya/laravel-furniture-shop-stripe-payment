<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::post('/webhooks', [WebhookController::class, 'handle']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::get('/products', [ProductController::class, 'index'])->name('dashboard');

	Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
	Route::delete('/carts/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');

	Route::post('/products/{product}/carts', [ProductCartController::class, 'store'])
		->name('product.carts.store');

	Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
	Route::get('/payments/success', [PaymentController::class, 'success'])->name('payments.success');
	Route::get('/payments/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');

	Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});
