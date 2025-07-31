<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// ADD THIS LINE
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('login');
});

Route::get('dash', function () {
    return view('dash');
});

Route::get('/auth/testing', function () {
    return view('auth.testing');
});

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/products/{category}', [ProductController::class, 'showCategory'])->name('products.category');

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/deals', [ProductController::class, 'deals'])->name('deals.index');

// ADD THIS NEW ROUTE FOR CATEGORY-SPECIFIC PRODUCTS


Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count'); // <== This is the one!
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');


Route::get('/test-simple-guest', function () {
    // This view should just say 'Hello' and nothing else
    return view('test-simple-guest');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';