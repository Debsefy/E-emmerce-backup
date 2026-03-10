<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;


class OrderController extends Controller
{
    // Show all orders for the logged-in customer
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('customer.orders.index', compact('orders'));
    }

    // Show details of a single order
    public function show($id)
    {
        $order = Order::where('customer_id', auth()->id())
                      ->where('id', $id)
                      ->firstOrFail();

        return view('customer.orders.show', compact('order'));
    }

    // Track order (basic example)
    public function track($id)
    {
        $order = Order::where('customer_id', auth()->id())
                      ->where('id', $id)
                      ->firstOrFail();

        // For now, just show tracking number/status
        return view('customer.orders.track', compact('order'));
    }
private function calculateShipping($customer)
{
    // Example: flat rate by region
    if ($customer->address === 'Lagos') {
        return 2000; // ₦2000 shipping
    } elseif ($customer->address === 'Abuja') {
        return 5000;
    } else {
        return 7000; // default
    }
}



    public function payment($id)
{
    $order = Order::with('products')->findOrFail($id);
    return view('customer.orders.payment', compact('order'));
}

public function showAddressForm()
{
    $customer = auth()->user();
    $cart = $customer->cart;

    if (!$cart || $cart->products->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    $totalPrice   = $cart->products->sum(fn($p) => $p->price * $p->pivot->quantity);
    $shippingCost = $this->calculateShipping($customer);
    $grandTotal   = $totalPrice + $shippingCost;

    return view('checkout.address', compact('cart', 'totalPrice', 'shippingCost', 'grandTotal'));
}

public function checkout(Request $request)
{
    $customer = auth()->user();
    $cart = $customer->cart;

    if (!$cart || $cart->products->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    $request->validate([
        'receiver_name'    => 'required|string|max:255',
        'sender_mobile'    => 'required|string|max:20',
        'delivery_address' => 'required|string|max:255',
        'delivery_country' => 'required|string',
        'delivery_region'  => 'required|string',
        'delivery_city'    => 'required|string',
    ]);

    // Calculate totals
    $totalPrice   = $cart->products->sum(fn($p) => $p->price * $p->pivot->quantity);
    $shippingCost = $this->calculateShipping($customer);
    $grandTotal   = $totalPrice + $shippingCost;   // ✅ define grandTotal here

    // Create order
    $order = Order::create([
        'customer_id'      => $customer->id,
        'status'           => 'pending',
        'total_amount'     => $grandTotal,
        'shipping_cost'    => $shippingCost,
        'receiver_name'    => $request->receiver_name,
        'sender_mobile'    => $request->sender_mobile,
        'delivery_address' => $request->delivery_address,
        'delivery_country' => $request->delivery_country,
        'delivery_region'  => $request->delivery_region,
        'delivery_city'    => $request->delivery_city,
    ]);

    foreach ($cart->products as $product) {
        $order->products()->attach($product->id, [
            'quantity' => $product->pivot->quantity,
            'price'    => $product->price,
        ]);
    }

    $cart->products()->detach();

    return redirect()->route('payment', $order->id);
}

public function processPayment(Request $request)
{
    $order = Order::findOrFail($request->order_id);

    $order->status = 'paid';
    $order->save();

    return redirect()->route('customer.orders.show', $order->id)
                     ->with('success', 'Payment successful!');
}

public function verifyPayment(Request $request)
{
    $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
        ->get("https://api.paystack.co/transaction/verify/".$request->reference);

    if ($response->successful() && $response['data']['status'] === 'success') {
        $order = Order::findOrFail($request->order_id);
        $order->status = 'paid';
        $order->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
}

public function getTrackingUrlAttribute()
{
    $courierLinks = [
        'DHL'   => 'https://www.dhl.com/track?trackingNumber=',
        'FedEx' => 'https://www.fedex.com/apps/fedextrack/?tracknumbers=',
        'UPS'   => 'https://www.ups.com/track?tracknum=',
        'USPS'  => 'https://tools.usps.com/go/TrackConfirmAction?tLabels=',
        'Oyo'   => 'https://oyoexpress.com/track?code=', // example local courier
    ];

    if ($this->courier && $this->tracking_number && isset($courierLinks[$this->courier])) {
        return $courierLinks[$this->courier] . $this->tracking_number;
    }

    return null;
}

}
