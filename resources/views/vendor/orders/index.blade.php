<!DOCTYPE html>
<html>
<head>
    <title>Vendor Orders</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        th, td { padding:10px; border:1px solid #ccc; }
        a { color:blue; text-decoration:none; }
    </style>
</head>
<body>
    <h1>Order List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user_id }}</td> <!-- later show customer name -->
            <td>${{ $order->total_amount }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <a href="/vendor/orders/view/{{ $order->id }}">View</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
