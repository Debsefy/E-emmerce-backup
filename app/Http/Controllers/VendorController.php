<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\User; // add at the top




class VendorController extends Controller
{

public function dashboard()
{
    $vendor = auth()->user();

    // Example queries (adjust to your models)
    $totalProducts = Product::where('vendor_id', $vendor->id)->count();
    $totalOrders   = Order::where('vendor_id', $vendor->id)->count();
    $totalSales    = Order::where('vendor_id', $vendor->id)
                          ->sum('total_amount');

    return view('vendor.dashboard', compact('totalProducts', 'totalOrders', 'totalSales'));
}
    // Product Management
    public function products()
    {
        $products = Product::all(); // later filter by vendor_id
        return view('vendor.products.index', compact('products'));
    }
    

   public function createProduct()
{
    $categories = Category::all();
    return view('vendor.products.create', compact('categories'));
}

   public function storeProduct(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('images/products'), $imageName);

    Product::create([
        'vendor_id' => auth()->id(),
        'category_id' => $request->category_id,
        'name' => $request->name,
        'description' => $request->description,
        'discount' => $request->discount ?? 0,
        'price' => $request->price,
        'stock' => $request->stock,
        'status' => 'pending', // vendor products need approval
        'image' => $imageName
        
    ]);



    return redirect('/vendor/products')->with('success','Product created successfully.');
}

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('vendor.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect('/vendor/products')->with('success','Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);
        return redirect('/vendor/products')->with('success','Product deleted successfully.');
    }

        // Order Management
    public function orders()
    {
        // Only show orders belonging to this vendor
        $orders = Order::where('vendor_id', auth()->id())->get();
        return view('vendor.orders.index', compact('orders'));
    }

    public function overview()
    {
        $vendorId = auth()->id();

        $totalProducts = Product::where('vendor_id', $vendorId)->count();
        $totalOrders   = Order::where('vendor_id', $vendorId)->count();
        $totalSales    = Order::where('vendor_id', $vendorId)->sum('total_amount');

        return view('vendor.dashboard', compact('totalProducts', 'totalOrders', 'totalSales'));
    }



    public function updateOrder(Request $request, $id)
    {
        $order = Order::where('vendor_id', auth()->id())->findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return redirect('/vendor/orders')->with('success','Order updated successfully.');
    }
    
public function pos(Request $request)
{
    $search = $request->input('search');

    $products = Product::where('vendor_id', auth()->id()) // only vendor’s products
        ->when($search, function ($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
        })
        ->get();

    return view('vendor.pos.index', compact('products', 'search'));
}

public function productDetail($id)
{
    $product = Product::where('vendor_id', auth()->id())->findOrFail($id);
    return view('vendor.pos.product-detail', compact('product'));
}

public function addToCart(Request $request, $id)
{
    $product = Product::where('vendor_id', auth()->id())->findOrFail($id);

    $cart = session()->get('vendor_cart', []);
    $cart[$id] = [
        "name" => $product->name,
        "quantity" => ($cart[$id]['quantity'] ?? 0) + $request->input('quantity', 1),
        "price" => $product->price,
        "image" => $product->image
    ];
    session()->put('vendor_cart', $cart);

    return redirect()->route('vendor.pos.cart');
}



public function viewCart()
{
    $cart = session()->get('vendor_cart', []);

    // Get all customers (users with role = 'customer')
    $customers = User::where('role', 'customer')->get();

    return view('vendor.pos.cart', compact('cart', 'customers'));
}

public function checkout(Request $request)
{
    $cart = session()->get('vendor_cart', []);
    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

$order = Order::create([
    'vendor_id'      => auth()->id(),
    'customer_id'    => $request->customer_id ?? 1,
    'receiver_name'  => $request->receiver_name ?? 'Walk-in Customer', // ✅ add this
    'status'         => 'completed',
    'payment_method' => $request->payment_method,
    'total_amount'   => $total,
]);

    foreach ($cart as $id => $item) {
        $order->products()->attach($id, [
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ]);
        Product::find($id)->decrement('stock', $item['quantity']);
    }

    session()->forget('vendor_cart');
    return redirect()->route('vendor.pos.receipt', $order->id);
}

public function receipt($id)
{
    $order = Order::with('products')->findOrFail($id);
    return view('vendor.pos.receipt', compact('order'));
}
    }



