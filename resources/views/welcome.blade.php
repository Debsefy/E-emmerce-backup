<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>E-Commerce Platform</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; text-align: center; }
        .container { margin-top: 100px; }
        h1 { color: #333; }
        .links { margin: 20px; }
        a { display: inline-block; margin: 10px; padding: 15px 25px; background: #333; color: #fff; text-decoration: none; border-radius: 5px; }
        a:hover { background: #555; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our E-Commerce Platform</h1>
        <p>Select your role to continue:</p>
        <div class="links">
            <a href="/login/admin">Admin Login</a>
            <a href="/login/vendor">Vendor Login</a>
            <a href="/register/vendor">Vendor Registration</a>
            <a href="/login/customer">Customer Login</a>
            <a href="/register/customer">Customer Registration</a>
        </div>
    </div>
</body>
</html>










<!DOCTYPE html>
<html>
<head>
    <title>My E-Commerce</title>
    <style>
        body { margin:0; font-family: Arial; }
        header { background:#f68b1e; color:#fff; padding:15px; display:flex; align-items:center; justify-content:space-between; }
        header h1 { margin:0; }
        nav a { color:#fff; margin:0 10px; text-decoration:none; }

        .hero { width:100%; height:300px; background:#ddd url('YOUR_HERO_IMAGE.jpg') no-repeat center center; background-size:cover; display:flex; align-items:center; justify-content:center; }
        .hero h2 { background:rgba(0,0,0,0.5); color:#fff; padding:20px; border-radius:5px; }

        .trust { background:#f9f9f9; padding:30px; text-align:center; }
        .trust h2 { margin-bottom:10px; }

        .products { padding:30px; }
        .products h2 { margin-bottom:20px; }
        .product-card { display:inline-block; width:200px; margin:10px; background:#fff; border:1px solid #ccc; padding:10px; text-align:center; }
        .product-card img { width:100%; height:150px; object-fit:cover; }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>My E-Commerce</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/shop">Shop</a>
            <a href="/login">Login</a>
            <a href="/cart">Cart</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="hero">
        <h2>Big Sale Week – Up to 65% Off!</h2>
    </div>

    <!-- Trust Section -->
    <div class="trust">
        <h2>Trusted by Thousands</h2>
        <p>Secure payments, fast delivery, and quality products.</p>
    </div>

    <!-- Featured Products -->
    <div class="products">
        <h2>Featured Products</h2>
        @foreach($featuredProducts as $product)
        <div class="product-card">
            <img src="YOUR_PRODUCT_IMAGE.jpg" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>${{ $product->price }}</p>
        </div>
        @endforeach
    </div>

    <!-- For You Products -->
    <div class="products">
        <h2>For You</h2>
        @foreach($forYouProducts as $product)
        <div class="product-card">
            <img src="YOUR_PRODUCT_IMAGE.jpg" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>${{ $product->price }}</p>
        </div>
        @endforeach
    </div>
</body>
</html>























<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index']);

Route::get('/', [HomeController::class, 'index']);


Route::get('/admin/approve-vendor/{id}', [AdminController::class, 'approveVendor'])->middleware('role:admin');


// Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('role:admin');
// Admin vendor approval page
// Admin Customers
Route::get('/admin/customers', [AdminController::class, 'viewCustomers'])->middleware('role:admin');

// Admin Categories
Route::get('/admin/categories', [AdminController::class, 'categories'])->middleware('role:admin');
Route::post('/admin/categories/store', [AdminController::class, 'storeCategory'])->middleware('role:admin');
Route::post('/admin/categories/update/{id}', [AdminController::class, 'updateCategory'])->middleware('role:admin');
Route::get('/admin/categories/delete/{id}', [AdminController::class, 'deleteCategory'])->middleware('role:admin');

// Admin Vendor Management
Route::get('/admin/vendors', [AdminController::class, 'vendorManagement'])->middleware('role:admin');

// Admin Orders & Payments
Route::get('/admin/orders', [AdminController::class, 'orders'])->middleware('role:admin');
Route::get('/admin/orders/view/{id}', [AdminController::class, 'viewOrder'])->middleware('role:admin');
Route::post('/admin/orders/update/{id}', [AdminController::class, 'updateOrder'])->middleware('role:admin');

Route::get('/admin/approve-vendors', [AdminController::class, 'showApproveVendors'])->middleware('role:admin');

// Approve a specific vendor
Route::get('/admin/approve-vendor/{id}', [AdminController::class, 'approveVendor'])->middleware('role:admin');




// Customer
Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->middleware('role:customer');

// Auth routes
Route::get('/login/admin', [AuthController::class, 'showAdminLogin']);
Route::post('/login/admin', [AuthController::class, 'adminLogin']);

Route::get('/login/vendor', [AuthController::class, 'showVendorLogin']);
Route::post('/login/vendor', [AuthController::class, 'vendorLogin']);
Route::get('/register/vendor', [AuthController::class, 'showVendorRegister']);
Route::post('/register/vendor', [AuthController::class, 'vendorRegister']);

Route::get('/login/customer', [AuthController::class, 'showCustomerLogin']);
Route::post('/login/customer', [AuthController::class, 'customerLogin']);
Route::get('/register/customer', [AuthController::class, 'showCustomerRegister']);
Route::post('/register/customer', [AuthController::class, 'customerRegister']);


// Vendor Dashboard
Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])->middleware('role:vendor');
Route::get('/vendor/dashboard', [VendorController::class, 'overview'])->middleware('role:vendor');

// Vendor Product Management
Route::get('/vendor/products', [VendorController::class, 'products'])->middleware('role:vendor');
Route::get('/vendor/products/create', [VendorController::class, 'createProduct'])->middleware('role:vendor');
Route::post('/vendor/products/store', [VendorController::class, 'storeProduct'])->middleware('role:vendor');
Route::get('/vendor/products/edit/{id}', [VendorController::class, 'editProduct'])->middleware('role:vendor');
Route::post('/vendor/products/update/{id}', [VendorController::class, 'updateProduct'])->middleware('role:vendor');
Route::get('/vendor/products/delete/{id}', [VendorController::class, 'deleteProduct'])->middleware('role:vendor');

// Vendor Order Management
Route::get('/vendor/orders', [VendorController::class, 'orders'])->middleware('role:vendor');
Route::get('/vendor/orders/view/{id}', [VendorController::class, 'viewOrder'])->middleware('role:vendor');
Route::post('/vendor/orders/update/{id}', [VendorController::class, 'updateOrder'])->middleware('role:vendor');


// Admin Product Management
Route::middleware(['role:admin'])->group(function () {
Route::get('/admin/products', [AdminController::class, 'products'])->middleware('role:admin');
Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->middleware('role:admin');
Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->middleware('role:admin');
Route::get('/admin/products/approve/{id}', [AdminController::class, 'approveProduct'])->middleware('role:admin');
Route::get('/admin/products/reject/{id}', [AdminController::class, 'rejectProduct'])->middleware('role:admin');
Route::get('/admin/products/delete/{id}', [AdminController::class, 'deleteProduct'])->middleware('role:admin');

    // Route::get('/admin/products/create', [AdminController::class, 'createProduct']);
    // Route::post('/admin/products/store', [AdminController::class, 'storeProduct']);
});


Route::get('/register/customer', [CustomerController::class, 'showRegisterForm']);
Route::post('/register/customer', [CustomerController::class, 'register']);

Route::get('/login/customer', [CustomerController::class, 'showLoginForm']);
Route::post('/login/customer', [CustomerController::class, 'login']);

Route::middleware(['role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard']);
    Route::get('/customer/orders', [CustomerController::class, 'orders']);
});


use App\Http\Controllers\ShopController;

Route::get('/shop', [ShopController::class, 'index']);
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');


use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');



















<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>E-Commerce Platform</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; text-align: center; }
        .container { margin-top: 100px; }
        h1 { color: #333; }
        .links { margin: 20px; }
        a { display: inline-block; margin: 10px; padding: 15px 25px; background: #333; color: #fff; text-decoration: none; border-radius: 5px; }
        a:hover { background: #555; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our E-Commerce Platform</h1>
        <p>Select your role to continue:</p>
        <div class="links">
            <a href="/login/admin">Admin Login</a>
            <a href="/login/vendor">Vendor Login</a>
            <a href="/register/vendor">Vendor Registration</a>
            <a href="/login/customer">Customer Login</a>
            <a href="/register/customer">Customer Registration</a>
        </div>
    </div>
</body>
</html>


<!-- Hero Section -->
<!-- <section class="hero-slider">
  <div class="slide active">
    <img src="{{ asset('/image/20260222_142733.jpg') }}" alt="Promo 1">
    <div class="hero-text">
      <h1>70% OFF Today</h1>
      <p>On fashion, electronics & more</p>
      <a href="#products" class="hero-btn">Buy Now</a>
    </div>
  </div>
  <div class="slide">
    <img src="{{ asset('/image/20260222_142558.jpg') }}" alt="Promo 2">
    <div class="hero-text">
      <h1>Flash Deals</h1>
      <p>Limited stock, don’t miss out</p>
      <a href="#products" class="hero-btn">Shop Now</a>
    </div>
  </div>
  <div class="slide">
    <img src="{{ asset('/image/20260222_142558.jpg') }}" alt="Promo 3">
    <div class="hero-text">
      <h1>New Arrivals</h1>
      <p>Fresh styles for every season</p>
      <a href="#products" class="hero-btn">Explore</a>
    </div>
  </div>
  <div class="slide">
    <img src="images/hero4.jpg" alt="Promo 4">
    <div class="hero-text">
      <h1>Tech Gadgets</h1>
      <p>Smart deals on smart devices</p>
      <a href="#products" class="hero-btn">Discover</a>
    </div>
  </div>
  <div class="slide">
    <img src="images/hero5.jpg" alt="Promo 5">
    <div class="hero-text">
      <h1>Home Essentials</h1>
      <p>Upgrade your living space</p>
      <a href="#products" class="hero-btn">Shop Now</a>
    </div>
  </div>
</section> -->







<!DOCTYPE html>
<html>
<head>
    <title>My E-Commerce</title>
    <style>
        body { margin:0; font-family: Arial; }
        header { background:#f68b1e; color:#fff; padding:15px; display:flex; align-items:center; justify-content:space-between; }
        header h1 { margin:0; }
        nav a { color:#fff; margin:0 10px; text-decoration:none; }

        .hero { width:100%; height:300px; background:#ddd url('YOUR_HERO_IMAGE.jpg') no-repeat center center; background-size:cover; display:flex; align-items:center; justify-content:center; }
        .hero h2 { background:rgba(0,0,0,0.5); color:#fff; padding:20px; border-radius:5px; }

        .trust { background:#f9f9f9; padding:30px; text-align:center; }
        .trust h2 { margin-bottom:10px; }

        .products { padding:30px; }
        .products h2 { margin-bottom:20px; }
        .product-card { display:inline-block; width:200px; margin:10px; background:#fff; border:1px solid #ccc; padding:10px; text-align:center; }
        .product-card img { width:100%; height:150px; object-fit:cover; }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>My E-Commerce</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/shop">Shop</a>
            <a href="/login">Login</a>
            <a href="/cart">Cart</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="hero">
        <h2>Big Sale Week – Up to 65% Off!</h2>
    </div>

    <!-- Trust Section -->
    <div class="trust">
        <h2>Trusted by Thousands</h2>
        <p>Secure payments, fast delivery, and quality products.</p>
    </div>

    <!-- Featured Products -->
    <div class="products">
        <h2>Featured Products</h2>
        @foreach($featuredProducts as $product)
        <div class="product-card">
            <img src="YOUR_PRODUCT_IMAGE.jpg" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>${{ $product->price }}</p>
        </div>
        @endforeach
    </div>

    <!-- For You Products -->
    <div class="products">
        <h2>For You</h2>
        @foreach($forYouProducts as $product)
        <div class="product-card">
            <img src="YOUR_PRODUCT_IMAGE.jpg" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>${{ $product->price }}</p>
        </div>
        @endforeach
    </div>
</body>
</html>




/* SIDEBAR */
.sidebar {
    width: 18%;
    background: white;
    padding: 10px;
    border-radius: 6px;
}

.sidebar a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: black;
    padding: 8px;
    font-size: 14px;
}

.sidebar img {
    height: 18px;
    margin-right: 10px;
}

/* HERO */
.hero {
    width: 60%;
    margin: 0 15px;
}

.hero img {
    width: 100%;
    border-radius: 6px;
}

/* RIGHT PANEL */
.right-panel {
    width: 22%;
}

.call-box {
    background: white;
    padding: 10px;
    display: flex;
    align-items: center;
    border-radius: 6px;
    margin-bottom: 10px;
}

.call-box img {
    height: 25px;
    margin-right: 10px;
}

.panel-link {
    display: flex;
    align-items: center;
    background: white;
    padding: 10px;
    margin-bottom: 10px;
    text-decoration: none;
    color: black;
    border-radius: 6px;
}

.panel-link img {
    height: 20px;
    margin-right: 10px;
}

.join-box {
    background: #ff9900;
    padding: 20px;
    text-align: center;
    border-radius: 6px;
    color: white;
}

.join-box a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 15px;
    background: white;
    color: #ff9900;
    text-decoration: none;
    border-radius: 4px;
}

/* ========================= */
/* HOVER EFFECTS */
/* ========================= */

.sidebar a:hover,
.panel-link:hover,
.header-links a:hover {
    background: #f2f2f2;
    transform: translateX(3px);
    transition: 0.3s ease;
}

.search-bar button:hover {
    background: #e68a00;
    transition: 0.3s ease;
}

.join-box a:hover {
    background: black;
    color: white;
    transition: 0.3s ease;
}

/* ========================= */
/* MEGA MENU */
/* ========================= */

.menu-item {
    position: relative;
}

.mega-menu {
    position: absolute;
    left: 100%;
    top: 0;
    width: 600px;
    background: white;
    display: none;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    border-radius: 6px;
    z-index: 100;
    display: flex;
    gap: 40px;
}

.mega-column {
    display: flex;
    flex-direction: column;
}

.mega-column h4 {
    margin-bottom: 10px;
    font-size: 15px;
}

.mega-column a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
    margin-bottom: 6px;
}

.mega-column a:hover {
    color: #ff9900;
}

.mega-image img {
    width: 180px;
    border-radius: 6px;
}

.menu-item:hover .mega-menu {
    display: flex;
}

/* ========================= */
/* SMOOTH TRANSITIONS */
/* ========================= */

a,
button,
.mega-menu {
    transition: all 0.3s ease;
}

/* ========================= */
/* RESPONSIVE DESIGN */
/* ========================= */

@media (max-width: 992px) {

    .main-content {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        margin-bottom: 15px;
    }

    .hero {
        width: 100%;
        margin: 0 0 15px 0;
    }

    .right-panel {
        width: 100%;
    }

    .mega-menu {
        position: static;
        width: 100%;
        flex-direction: column;
        box-shadow: none;
        padding: 10px;
    }

}

@media (max-width: 768px) {

    .header-flex {
        flex-direction: column;
        gap: 10px;
    }

    .search-bar {
        width: 100%;
    }

    .header-links {
        display: flex;
        justify-content: center;
        width: 100%;
    }

}

@media (max-width: 480px) {

    .top-bar {
        display: none;
    }

    .search-bar input {
        width: 70%;
    }

    .search-bar button {
        width: 30%;
    }

}