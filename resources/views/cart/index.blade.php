<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
 @include('layouts.customer-header')

<div class="cart-container">
    <h1 class="cart-title">Your Cart</h1>

    @if($products->isEmpty())
        <p class="cart-empty">Your cart is empty.</p>
    @else
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td data-label="Image"><img src="{{ asset('images/products/' . $product->image) }}" class="cart-img"></td>
                        <td data-label="Product">{{ $product->name }}</td>
                        <td data-label="price">₦{{ number_format($product->price, 2) }}</td>
                        <td data-label="Quantity">
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="cart-update-form">
                                @csrf
                                @method('PUT')
                                <div class="quantity-control">
                                    <button type="submit" name="action" value="decrease" class="qty-btn">−</button>
                                    <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1" class="qty-input">
                                    <button type="submit" name="action" value="increase" class="qty-btn">+</button>
                                </div>
                            </form>
                        </td>
                        <td data-label="Remove">
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(!$products->isEmpty())
    <div class="order-summary">
    <h2>Order Summary</h2>
    <p>Total Items: {{ $products->sum('pivot.quantity') }}</p>
    <p>Total Price: ₦{{ number_format($totalPrice, 2) }}</p>
    <p>Shipping: ₦{{ number_format($shippingCost, 2) }}</p>
    <p><strong>Grand Total: ₦{{ number_format($grandTotal, 2) }}</strong></p>

    <form action="{{ route('checkout.address') }}" method="GET">
    <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
</form>

</div>

    @endif
</div>



</body>
</html>
