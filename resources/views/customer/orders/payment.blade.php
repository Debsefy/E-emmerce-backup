<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Payment</title>
    @vite(['resources/css/style.css'])
</head>
<body>
    @include('layouts.customer-header')

    <div class="checkout-container">
        <!-- Progress bar -->
        <div class="checkout-steps">
            <span class="step active">Cart</span>
            <span class="step active">Checkout</span>
            <span class="step active">Payment</span>
            <span class="step">Confirmation</span>
        </div>

        <!-- Order summary -->
        <div class="order-summary">
            <h2>Order #{{ $order->id }}</h2>
            <p>Status: {{ ucfirst($order->status) }}</p>

            <h3>Items</h3>
            <ul>
                @foreach($order->products as $product)
                    <li>
                        {{ $product->name }} 
                        (x{{ $product->pivot->quantity }}) 
                        - ₦{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}
                    </li>
                @endforeach
            </ul>

            <p>Subtotal: ₦{{ number_format($order->total_amount - $order->shipping_cost, 2) }}</p>
            <p>Shipping: ₦{{ number_format($order->shipping_cost, 2) }}</p>
            <p><strong>Grand Total: ₦{{ number_format($order->total_amount, 2) }}</strong></p>
        </div>

        <!-- Customer info -->
        <div class="customer-info">
            <h3>Shipping Address</h3>
            <p>{{ auth()->user()->name }}</p>
            <p>{{ auth()->user()->address }}</p>
            <p>{{ auth()->user()->phone }}</p>
        </div>

        <!-- Payment options
        <div class="payment-options">
            <h3>Select Payment Method</h3>
            <form action="{{ route('process.payment') }}" method="POST">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">

                <label>
                    <input type="radio" name="payment_method" value="paystack" checked>
                    Pay with Paystack
                </label><br>

                <label>
                    <input type="radio" name="payment_method" value="flutterwave">
                    Pay with Flutterwave
                </label><br>

                <label>
                    <input type="radio" name="payment_method" value="stripe">
                    Pay with Stripe
                </label><br>

                <label>
                    <input type="radio" name="payment_method" value="cod">
                    Cash on Delivery
                </label><br>

                <button type="submit" class="btn btn-success">Pay Now</button>
            </form>
        </div>
    </div> -->
<button type="button" class="btn btn-success" onclick="payWithPaystack()">Pay Now</button>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
function payWithPaystack(){
  var handler = PaystackPop.setup({
    key: '{{ env('PAYSTACK_PUBLIC_KEY') }}',
    email: '{{ auth()->user()->email }}',
    amount: {{ $order->total_amount * 100 }}, // Paystack expects kobo
    currency: "NGN",
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // unique reference
    metadata: {
       custom_fields: [
          {
              display_name: "Order ID",
              variable_name: "order_id",
              value: "{{ $order->id }}"
          }
       ]
    },
    callback: function(response){
        // Send reference to backend to verify
        fetch("{{ route('verify.payment') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                reference: response.reference,
                order_id: "{{ $order->id }}"
            })
        }).then(res => res.json())
          .then(data => {
              if(data.success){
                  window.location.href = "/customer/orders/{{ $order->id }}";
              } else {
                  alert("Payment verification failed");
              }
          });
    },
    onClose: function(){
        alert('Payment window closed.');
    }
  });
  handler.openIframe();
}
</script>


</body>
</html>
