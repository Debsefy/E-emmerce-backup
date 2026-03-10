<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body>

<div class="product-detail">
    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>₦{{ number_format($product->price, 2) }}</p>

    <form action="{{ route('vendor.pos.cart.add', $product->id) }}" method="POST">
        @csrf
        <label>Quantity:</label>
        <input type="number" name="quantity" value="1" min="1">
        <button type="submit">Add to Cart</button>
    </form>
</div>



</body>
</html>