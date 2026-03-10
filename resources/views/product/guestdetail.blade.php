<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     @vite(['resources/css/style.css', 'resources/js/my.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
     @include('layouts.header')
 
<div class="product-detail guest-details">
    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>₦{{ number_format($product->price, 2) }}</p>

    <p class="login-prompt">
        Please <a href="{{ route('login.customer') }}">login</a> or 
        <a href="{{ route('register.customer') }}">register</a> to purchase this product.
    </p>
</div>


</body>
</html>