<h1>Order #{{ $order->id }}</h1>
<p>Status: {{ ucfirst($order->status) }}</p>
<p>Total: ₦{{ number_format($order->total_amount, 2) }}</p>
<p>Items:</p>
<ul>
    @foreach($order->products as $product)
        <li>{{ $product->name }} x {{ $product->pivot->quantity }}</li>
    @endforeach
</ul>
