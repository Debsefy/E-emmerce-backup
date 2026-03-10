<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
public function guestShow($id)
{
    $product = Product::findOrFail($id);
    return view('product.guestdetail', compact('product'));
}


public function show($id)
{
    $product = Product::findOrFail($id);

    if (auth()->check() && auth()->user()->role === 'customer') {
        $related = Product::where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id)
                          ->take(4)
                          ->get();
        return view('customer.shop.show', compact('product', 'related'));
    }

    if (auth()->check() && auth()->user()->role === 'vendor') {
        return view('vendor.products.show', compact('product'));
    }

    if (auth()->check() && auth()->user()->role === 'admin') {
        return view('admin.products.show', compact('product'));
    }

    // Fallback
    return view('products.guestdetail', compact('product'));
}

public function checkout(Request $request)
{
    $customerId = auth()->id();
    $cart = Cart::where('customer_id', $customerId)->firstOrFail();
    $products = $cart->products;   // ✅ now returns a collection

    $total = $products->sum(function ($product) {
        return $product->price * $product->pivot->quantity;

        $shippingCost = $this->calculateShipping(auth()->user());
$total = $products->sum(fn($p) => $p->price * $p->pivot->quantity);
$grandTotal = $total + $shippingCost;

$order = Order::create([
    'customer_id'   => $customerId,
    'status'        => 'pending',
    'payment_method'=> $request->payment_method,
    'total_amount'  => $grandTotal,
    'shipping_cost' => $shippingCost,
]);

    });

    $order = Order::create([
        'customer_id'   => $customerId,
        'status'        => 'pending',
        'payment_method'=> $request->payment_method,
        'total_amount'  => $total,
    ]);

    foreach ($products as $product) {
        $order->products()->attach($product->id, [
            'quantity' => $product->pivot->quantity,
            'price'    => $product->price,
        ]);

        $product->decrement('stock', $product->pivot->quantity);
    }

    // Clear cart
    $cart->products()->detach();

    // Redirect to payment page
    return redirect()->route('payment', $order->id);
}



    public function payment($id)
    {
        $order = Order::with('products')->findOrFail($id);
        return view('customer.orders.payment', compact('order'));
    }
}

