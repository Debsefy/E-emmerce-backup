<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
</head>
<body>
<h2>Tracking</h2>
<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
<p><strong>Courier:</strong> {{ $order->courier ?? 'Not assigned' }}</p>
<p><strong>Tracking Number:</strong> {{ $order->tracking_number ?? 'Not available' }}</p>

@if($order->tracking_url)
    <p><a href="{{ $order->tracking_url }}" target="_blank">Track Package</a></p>
@endif

</body>
</html>


