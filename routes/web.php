<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', fn () => to_route('products.index'))->name('home');
Route::resource('products', ProductController::class)->only(['index','show']);
Route::resource('products.reviews', ReviewController::class)->only(['index','create']);
Route::resource('cart', CartController::class)->only(['index','update']);
//Route::resource('order', OrderController::class)->only(['index','store','update']);
Route::get('order/address', [OrderController::class, 'address'])
        ->name('address');
// Route::post('order/address', [OrderController::class, 'validateAddress'])
// ->name('order.address');
// Route::post('order/address', [OrderController::class, 'store'])
// ->name('address.store');
Route::post('order/delivery', [OrderController::class, 'validateAddress'])
->name('order.delivery');
Route::post('order/validateOrder', [OrderController::class, 'validateOrder'])
->name('order.validateOrder');
Route::post('order/payment', [OrderController::class, 'paymentOrder'])
->name('order.payment');
//Route::post('order/delivery', [OrderController::class, 'edit'])
//->name('order.delivery');

Route::get('send-mail', [MailController::class, 'index']);


// Route::get('/login', function () {
//     return view('login');
// })->name('login');

//Route::get('/', fn() => to_route('jobAds.index'));

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
