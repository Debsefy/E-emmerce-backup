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
    
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->customer->name }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>₦{{ number_format($order->total_amount, 2) }}</td>
            <td>
                <a href="{{ route('admin.orders.view', $order->id) }}" class="btn btn-info">View</a>
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>

