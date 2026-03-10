<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        .card { background:#fff; padding:20px; margin:20px; border-radius:5px; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        th, td { padding:10px; border:1px solid #ccc; }
    </style>
</head>
<body>
    <h1>Order Details</h1>

    <div class="card">
        <h2>Order #{{ $order->id }}</h2>
        <p><strong>Customer ID:</strong> {{ $order->user_id }}</p>
        <p><strong>Vendor ID:</strong> {{ $order->vendor_id }}</p>
        <p><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
    </div>

    <h2>Products</h2>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        @foreach($order->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->quantity }}</td>
            <td>${{ $product->price }}</td>
        </tr>
        @endforeach
    </table>

    <h2>Update Status</h2>
    <form method="POST" action="/vendor/orders/update/{{ $order->id }}">
        @csrf
        <select name="status">
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
