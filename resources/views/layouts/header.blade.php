<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/style.css', 'resources/js/my.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <!-- <div class="top-bar">
    <div class="container flex-between">
        <a href="/login/vendor">Sell On E-mart</a>
         <a href="/login/admin">Admin Login</a>
        <div class="top-links">
            <a href="#">Pay</a>
            <a href="#">Delivery</a>
        </div>
    </div>
</div>
    <header class="main-header">
    <div class="container header-flex">

     
        <a href="#" class="logo">
          
            <img src="{{ asset('image/jum.PNG') }}" alt="Logo">
        </a>

       
        <div class="search-bar">
            <input type="text" placeholder="Search products, brands and categories">
            <button>Search</button>
        </div>

        <div class="header-links">
            <a href="login/customer">
                <img src="images/account-icon.png" alt="">
               login
            </a>

                        <a href="customer/register">
                <img src="images/account-icon.png" alt="">
              Register
            </a>
              
            <a href="#">
                <img src="images/help-icon.png" alt="">
                Help
            </a>

            <a href="/cart" class="cart-link">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
            </a>

        </div>

    </div>
</header> -->

<header class="main-header">
    <div class="container header-flex">

        <!-- LOGO -->
        <a href="#" class="logo">
            <img src="your-logo.png" alt="Logo">
        </a>

        <!-- SEARCH BAR -->
       

        <!-- <div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search products, brands and categories" required>
        <button type="submit">Search</button>
    </form>
</div> -->

        
        <!-- MOBILE TOGGLE BUTTON -->
        <button class="menu-toggle" id="menuToggle">☰</button>

        <!-- HEADER LINKS -->
        <nav class="header-links" id="headerLinks">
            <a href="{{ route('login.customer') }}"><i class="fas fa-user"></i> Login</a>
<a href="{{ route('register.customer') }}"><i class="fas fa-user-plus"></i> Register</a>

            <a href="#"><i class="fas fa-question-circle"></i> Help</a>
<a href="#" class="cart-link">
    <i class="fas fa-shopping-cart"></i>
    <span class="cart-count">
    @auth
        {{ auth()->user()->cart?->products?->sum('pivot.quantity') ?? 0 }}

    @else
        {{ array_sum(session('cart', [])) }}
    @endauth
</span>

</a>


        </nav>

    </div>
</header>


 
</body>
</html>