<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="receipt">
    <h2>POS Receipt</h2>
    <p>Order ID: {{ $order->id }}</p>
    <p>Date: {{ $order->created_at->format('d M Y H:i') }}</p>
    <p>Vendor: {{ auth()->user()->name }}</p>

    <table>
        <thead>
            <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>₦{{ number_format($product->pivot->price, 2) }}</td>
                <td>₦{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Grand Total: ₦{{ number_format($order->total, 2) }}</h3>
    <p>Payment Method: {{ ucfirst($order->payment_method) }}</p>
</div>


</body>
</html>