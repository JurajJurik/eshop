<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', fn () => to_route('products.index'))->name('home');
Route::resource('products', ProductController::class)->only(['index','show']);
Route::resource('products.reviews', ReviewController::class)->only(['index','create']);
Route::resource('products', ProductController::class)->only(['index','show']);
Route::resource('cart', CartController::class)->only(['index','update']);

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
