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

<header class="site-header">
    <div class="container header-flex">

        <!-- LOGO -->
        <a href="#" class="logo">
            <img src="your-logo.png" alt="Logo">
        </a>

  

        <!-- MOBILE TOGGLE BUTTON -->
        <button class="menu-toggle" id="menuToggle">☰</button>

        <!-- NAVIGATION LINKS -->
        <nav class="header-links" id="headerLinks">
            <a href="{{ url('customer/dashboard') }}"><i class="fas fa-user-circle"></i> Account</a>
            <a href="{{ url('login/customer') }}"><i class="fas fa-user-plus"></i> Logout</a>
            <a href="#"><i class="fas fa-question-circle"></i> Help</a>

 

 <a href="{{ route('cart.index') }}" class="cart-link">
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

 <script src="{{ asset('js/my.js') }}"></script>
</body>
</html>