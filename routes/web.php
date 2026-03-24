<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController; // NEW: Import the CustomerController
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Middleware\RoleMiddleware;

// ADMIN ROUTE
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    // NEW: Route for viewing a single order
    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    // NEW: Route to update an order's status
    Route::put('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update_status');
    
    Route::get('/admin/deals', [AdminController::class, 'deals'])->name('admin.deals');
    Route::patch('/admin/users/{user}', [AdminController::class, 'updateRole'])->name('admin.users.update_role');

    // ADMIN PRODUCT EDIT & DELETE ROUTES
    Route::get('/admin/products/{product}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [AdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy');

    // NEW: ADMIN DEALS MANAGEMENT ROUTES
    Route::post('/admin/products/{product}/toggle-deal', [AdminController::class, 'toggleDealStatus'])->name('admin.deals.toggle');
    // NEW: Route for the modal's AJAX submission
    Route::post('/admin/products/update-deal-percentage', [AdminController::class, 'updateDealPercentage'])->name('admin.products.updateDealPercentage');
    
    // NEW: Route for approving a vendor's product
    Route::post('/admin/products/{product}/approve', [AdminController::class, 'approve'])->name('admin.products.approve');

    // NEW: Admin Review Management
    Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::delete('/admin/reviews/{review}', [AdminController::class, 'deleteReview'])->name('admin.reviews.delete');
});

// VENDOR ROUTE
Route::middleware(['auth', RoleMiddleware::class . ':vendor'])->group(function () {
    Route::get('/vendor', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/vendor/products', [VendorController::class, 'myProducts'])->name('vendor.products');
    Route::get('/vendor/products/create', [VendorController::class, 'create'])->name('vendor.products.create');
    Route::post('/vendor/products', [VendorController::class, 'store'])->name('vendor.products.store');
    Route::get('/vendor/products/{product}/edit', [VendorController::class, 'edit'])->name('vendor.products.edit');
    Route::put('/vendor/products/{product}', [VendorController::class, 'update'])->name('vendor.products.update');
    Route::get('/vendor/sales', [VendorController::class, 'mySales'])->name('vendor.sales');
    Route::delete('/vendor/products/{product}', [VendorController::class, 'destroy'])->name('vendor.products.destroy');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('login', function () {
    return view('login');
});

Route::get('dash', function () {
    return view('dash');
});

Route::get('/auth/testing', function () {
    return view('auth.testing');
});

// IMPORTANT: Product Routes must be ordered carefully to avoid conflicts.
Route::post('/products/{product}/review', [ProductController::class, 'storeReview'])->name('products.review.store')->middleware('auth');

// NEW: Routes for editing and deleting reviews.
Route::patch('/reviews/{review}', [ProductController::class, 'updateReview'])->name('reviews.update')->middleware('auth');
Route::delete('/reviews/{review}', [ProductController::class, 'deleteReview'])->name('reviews.delete')->middleware('auth');

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')->where('id', '[0-9]+');
Route::get('/products/{category}', [ProductController::class, 'showCategory'])->name('products.category');
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/deals', [ProductController::class, 'deals'])->name('deals.index');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove', [CartController::class, 'removeCartItem'])->name('cart.remove');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');

Route::get('/test-simple-guest', function () {
    return view('test-simple-guest');
});

Route::get('/thank-you', function () {
    return view('thankyou');
})->name('thankyou');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // NEW: Customer Order Management Routes
    Route::get('/my-orders', [CustomerController::class, 'myOrders'])->name('customer.orders.index');
    Route::put('/orders/{order}/cancel', [CustomerController::class, 'cancelOrder'])->name('customer.orders.cancel');
});

require __DIR__.'/auth.php';