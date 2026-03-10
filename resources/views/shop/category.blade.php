<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/shop.css', 'resources/js/my.js'])
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
 @include('layouts.customer-header')

 <section class="category-hero">
  <div class="hero-content">
    <h1>Electronics Deals</h1>
    <p>Discover the latest gadgets and save up to 50% today!</p>
    <a href="#products" class="hero-btn">Shop Now</a>
  </div>
</section>

 <div class="container"> 
    <h1>{{ $category->name }}</h1>

    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card">
                <a href="{{ route('product.show', $product->id) }}">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                </a>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>₦{{ number_format($product->price, 2) }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="buy-btn">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            </div>
        @empty
            <p>No products found in this category.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    {{ $products->links() }}

</div>


</body>
</html>