<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        .container { width:80%; margin:auto; padding:20px; }
        .order-card {
            background:#fff;
            padding:15px;
            margin-bottom:10px;
            border-radius:5px;
            box-shadow:0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Orders</h1>

        @forelse($orders as $order)
            <div class="order-card">
                <p><strong>Order #{{ $order->id }}</strong></p>
                <p>Status: {{ $order->status }}</p>
                <p>Total: ₦{{ number_format($order->total_amount, 2) }}</p>
                <p><a href="{{ route('customer.orders.show', $order->id) }}">View Details</a> |
                   <a href="{{ route('customer.orders.track', $order->id) }}">Track Order</a></p>
            </div>
        @empty
            <p>You have no orders yet.</p>
        @endforelse
    </div>
</body>
</html>
