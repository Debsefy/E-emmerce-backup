<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body>
    <h1>Track Order #{{ $order->id }}</h1>
<p><strong>Tracking Number:</strong> {{ $order->tracking_number ?? 'Not available' }}</p>

@if($order->tracking_url)
    <a href="{{ $order->tracking_url }}" target="_blank" class="btn btn-primary">
        Track Package
    </a>
@endif


<p>Status: {{ $order->status }}</p>

</body>
</html>