<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body>





<div class="pos-home">
    <h2>Sell Products (POS)</h2>
    <form action="{{ route('vendor.pos') }}" method="GET">
        <input type="text" name="search" placeholder="Search products..." value="{{ $search ?? '' }}">
        <button type="submit">Search</button>
    </form>

    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card">
                <a href="{{ route('vendor.pos.product-detail', $product->id) }}">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>₦{{ number_format($product->price, 2) }}</p>
                </a>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>
</div>



</body>
</html>