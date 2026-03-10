<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body>

<div class="cart">
    <h2>POS Cart</h2>
    @if($cart)
        <table>
            <thead>
                <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>₦{{ number_format($item['price'], 2) }}</td>
                    <td>₦{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('vendor.pos.checkout') }}" method="POST">
    @csrf
    <label>Customer:</label>
    <select name="customer_id">
        <option value="1">Walk-in Customer</option>
        <!-- Or loop through registered customers -->
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>

    <label>Payment Method:</label>
    <select name="payment_method">
        <option value="cash">Cash</option>
        <option value="card">Card</option>
        <option value="transfer">Bank Transfer</option>
    </select>

    <button type="submit">Checkout</button>
</form>

    @else
        <p>No items in cart.</p>
    @endif
</div>




</body>
</html>