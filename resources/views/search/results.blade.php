<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="search-results">
    <h2>Search Results for "{{ $query }}"</h2>

    @if($products->count())
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <h3>{{ $product->name }}</h3>
                    <p>₦{{ number_format($product->price, 2) }}</p>
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    @else
        <p>No products found matching your search.</p>
    @endif
</div>


</body>
</html>