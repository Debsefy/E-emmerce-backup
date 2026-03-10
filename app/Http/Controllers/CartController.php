<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    // Show the logged-in customer's cart
public function index()
{
    if (!auth()->check()) {
        // Guest cart from session
        $sessionCart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($sessionCart))->get();

        foreach ($products as $product) {
            $product->pivot = (object)['quantity' => $sessionCart[$product->id]];
        }

        $totalPrice = collect($products)->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        // For guests, you can set a flat shipping or skip
        $shippingCost = 2000; // example flat rate
        $grandTotal   = $totalPrice + $shippingCost;

        return view('cart.index', compact('products', 'totalPrice', 'shippingCost', 'grandTotal'));
    }

    // Logged-in customer cart
    $customer = auth()->user();
    $cart = Cart::firstOrCreate(['customer_id' => $customer->id]);
    $products = $cart->products;

    $totalPrice = $products->sum(function ($product) {
        return $product->price * $product->pivot->quantity;
    });

    // Example shipping calculation based on address
    $shippingCost = $this->calculateShipping($customer);
    $grandTotal   = $totalPrice + $shippingCost;

    return view('cart.index', compact('cart', 'products', 'totalPrice', 'shippingCost', 'grandTotal'));
}


public function add(Request $request, $id)
{
    $quantity = $request->input('quantity', 1);

    if (!auth()->check()) {
        // Guest cart in session
        $cart = session()->get('cart', []);
        $cart[$id] = ($cart[$id] ?? 0) + $quantity;
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cartCount' => array_sum($cart)
        ]);
    }

    // Customer cart in DB
    $customer = auth()->user();
$cart = Cart::firstOrCreate(['customer_id' => $customer->id]);
    $product = Product::findOrFail($id);
    $cart->products()->syncWithoutDetaching([
        $product->id => ['quantity' => $quantity]
    ]);

    $cartCount = $cart->products->sum('pivot.quantity');

    return response()->json([
        'success' => true,
        'cartCount' => $cartCount
    ]);
}

    // Update product quantity in cart
    public function update(Request $request, $id)
    {
       $customer = auth()->user();
$cart = Cart::firstOrCreate(['customer_id' => $customer->id]);

        if ($cart->products()->where('product_id', $id)->exists()) {
            $action = $request->action;

            $currentQuantity = $cart->products()->find($id)->pivot->quantity;

            if ($action === 'increase') {
                $newQuantity = $currentQuantity + 1;
            } elseif ($action === 'decrease') {
                $newQuantity = max(1, $currentQuantity - 1);
            } else {
                $newQuantity = max(1, (int)$request->quantity);
            }

            $cart->products()->updateExistingPivot($id, ['quantity' => $newQuantity]);
        }

        return back()->with('success', 'Cart updated!');
    }

    // Remove product from cart
    public function remove($id)
    {
       $customer = auth()->user();
$cart = Cart::firstOrCreate(['customer_id' => $customer->id]);

        $cart->products()->detach($id);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
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


}
