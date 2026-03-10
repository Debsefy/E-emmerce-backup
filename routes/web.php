<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
   use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;


// Auth::routes(); 

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


use App\Http\Controllers\CategoryController;


// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// -------------------- ADMIN --------------------
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/customers', [AdminController::class, 'viewCustomers']);

    // Categories
    Route::get('/admin/categories', [AdminController::class, 'categories']);
    Route::post('/admin/categories/store', [AdminController::class, 'storeCategory']);
    Route::post('/admin/categories/update/{id}', [AdminController::class, 'updateCategory']);
    Route::get('/admin/categories/delete/{id}', [AdminController::class, 'deleteCategory']);

    // Vendors
    Route::get('/admin/vendors', [AdminController::class, 'vendorManagement']);
    Route::get('/admin/approve-vendors', [AdminController::class, 'showApproveVendors']);
    Route::get('/admin/approve-vendor/{id}', [AdminController::class, 'approveVendor']);

    // Orders
    Route::get('/admin/orders', [AdminController::class, 'orders']);
      Route::post('/admin/orders/update/{id}', [AdminController::class, 'updateOrder']);
    Route::get('/admin/orders/{id}', [AdminController::class, 'viewOrder'])->name('admin.orders.view');
    Route::get('/admin/orders/{id}/edit', [AdminController::class, 'editOrder'])->name('admin.orders.edit');
    Route::put('/admin/orders/{id}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');

    // Products
    Route::get('/admin/products', [AdminController::class, 'products']);
    Route::get('/admin/products/create', [AdminController::class, 'createProduct']);
    Route::post('/admin/products/store', [AdminController::class, 'storeProduct']);
    Route::get('/admin/products/approve/{id}', [AdminController::class, 'approveProduct']);
    Route::get('/admin/products/reject/{id}', [AdminController::class, 'rejectProduct']);
    Route::get('/admin/products/delete/{id}', [AdminController::class, 'deleteProduct']);
});

// -------------------- VENDOR --------------------
Route::middleware(['role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])
    ->name('vendor.dashboard');

    Route::get('/vendor/products', [VendorController::class, 'products']);
    Route::get('/vendor/products/create', [VendorController::class, 'createProduct']);
    Route::post('/vendor/products/store', [VendorController::class, 'storeProduct']);
    Route::get('/vendor/products/edit/{id}', [VendorController::class, 'editProduct']);
    Route::post('/vendor/products/update/{id}', [VendorController::class, 'updateProduct']);
    Route::get('/vendor/products/delete/{id}', [VendorController::class, 'deleteProduct']);

    Route::get('/vendor/orders', [VendorController::class, 'orders']);
    Route::get('/vendor/orders/view/{id}', [VendorController::class, 'viewOrder']);
    Route::post('/vendor/orders/update/{id}', [VendorController::class, 'updateOrder']);

         
});






// -------------------- CUSTOMER --------------------
Route::middleware(['role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard']);
    Route::get('/customer/orders', [CustomerController::class, 'orders']);
});

// -------------------- AUTH --------------------
Route::get('/login/admin', [AuthController::class, 'showAdminLogin']);
Route::post('/login/admin', [AuthController::class, 'adminLogin']);

Route::get('/login/vendor', [AuthController::class, 'showVendorLogin']);
Route::post('/login/vendor', [AuthController::class, 'vendorLogin']);
// Route::get('/register/vendor', [AuthController::class, 'showVendorRegister']);
// Route::post('/register/vendor', [AuthController::class, 'vendorRegister']);
Route::get('/register/vendor', [AuthController::class, 'showVendorRegister'])->name('vendor.register');
Route::post('/register/vendor', [AuthController::class, 'vendorRegister'])->name('vendor.register.submit');

// Customer login
Route::get('/login/customer', [AuthController::class, 'showCustomerLogin'])
    ->name('login.customer');
Route::post('/login/customer', [AuthController::class, 'customerLogin'])
    ->name('login.customer.submit');
Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->name('password.request');

// Customer register
Route::get('/register/customer', [AuthController::class, 'showCustomerRegister'])
    ->name('register.customer');
Route::post('/register/customer', [AuthController::class, 'customerRegister'])
    ->name('register.customer.submit');

// -------------------- SHOP --------------------
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');
Route::get('/shop/category/{slug}', [ShopController::class, 'categori'])->name('shop.categori');
Route::get('/shop/category/{id}', [ShopController::class, 'category'])->name('shop.category');


// -------------------- CART --------------------
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// Customer checkout
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

// Show address form
Route::get('/checkout/address', [OrderController::class, 'showAddressForm'])->name('checkout.address');

// Save address and create order
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

// Payment page
Route::get('/payment/{id}', [OrderController::class, 'payment'])->name('payment');

Route::post('/process-payment', [OrderController::class, 'processPayment'])->name('process.payment');

Route::post('/verify-payment', [OrderController::class, 'verifyPayment'])->name('verify.payment');


// -------------------- REVIEWS --------------------

// routes/web.php
Route::post('/product/{id}/reviews', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');


// -------------------- CUSTOMER --------------------
Route::middleware(['role:customer', 'auth'])->prefix('customer')->group(function () {
    // Dashboard
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('customer.orders');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('customer.orders.show');
    Route::get('/orders/{id}/track', [OrderController::class, 'track'])->name('customer.orders.track');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('customer.profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('customer.profile.update');

    // Addresses
    Route::get('/addresses', [AddressController::class, 'index'])->name('customer.addresses.index');
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('customer.addresses.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('customer.addresses.store');
});

// -------------------- LOGOUT --------------------
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // redirect to homepage after logout
})->name('logout');




Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.categories.delete');


});





Route::get('/guest/product/{id}', [ProductController::class, 'guestShow'])
    ->name('product.guestdetail');

// Customer product detail
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::middleware(['role:vendor'])->group(function () {
    // Vendor POS home
    Route::get('/vendor/pos', [ProductController::class, 'pos'])->name('vendor.pos');

    // Vendor product detail (uses ProductController@show)
    Route::get('/vendor/pos/product/{id}', [ProductController::class, 'show'])->name('vendor.pos.product-detail');

    // Cart + checkout
    Route::post('/vendor/pos/cart/add/{id}', [ProductController::class, 'addToCart'])->name('vendor.pos.cart.add');
    Route::get('/vendor/pos/cart', [ProductController::class, 'viewCart'])->name('vendor.pos.cart');
    Route::post('/vendor/pos/checkout', [ProductController::class, 'checkout'])->name('vendor.pos.checkout');
    Route::get('/vendor/pos/receipt/{id}', [ProductController::class, 'receipt'])->name('vendor.pos.receipt');
});


// Static pages
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/returns', 'pages.returns')->name('returns');
Route::view('/shipping', 'pages.shipping')->name('shipping');
Route::view('/privacy', 'pages.privacy')->name('privacy');

// Orders (customer only)
Route::middleware(['role:customer', 'auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});


Route::view('/terms', 'static.terms')->name('terms');
Route::view('/privacy', 'static.privacy')->name('privacy');
Route::view('/help', 'static.help')->name('help');




Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::middleware(['role:vendor'])->group(function () {
    Route::get('/vendor/pos', [VendorController::class, 'pos'])->name('vendor.pos');
    Route::get('/vendor/pos/product/{id}', [VendorController::class, 'productDetail'])->name('vendor.pos.product-detail');
    Route::post('/vendor/pos/cart/add/{id}', [VendorController::class, 'addToCart'])->name('vendor.pos.cart.add');
    Route::get('/vendor/pos/cart', [VendorController::class, 'viewCart'])->name('vendor.pos.cart');
    Route::post('/vendor/pos/checkout', [VendorController::class, 'checkout'])->name('vendor.pos.checkout');
    Route::get('/vendor/pos/receipt/{id}', [VendorController::class, 'receipt'])->name('vendor.pos.receipt');
});



Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
Route::get('/vendors/{id}', [VendorController::class, 'show'])->name('vendors.show');
