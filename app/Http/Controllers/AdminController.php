<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
class AdminController extends Controller
{
     public function dashboard()
    {
        $totalVendors = User::where('role', 'vendor')->count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalSales = Order::sum('total_amount'); // assumes orders table has total_amount column

        return view('admin.dashboard', compact('totalVendors', 'totalCustomers', 'totalSales'));
    }
    // Show list of vendors to approve
    public function showApproveVendors()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.approve-vendors', compact('vendors'));
    }

    // Approve a specific vendor
    public function approveVendor($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->status = 'approved';
        $vendor->save();

        return redirect()->back()->with('success', 'Vendor approved successfully.');
    }

        // View Customers
    public function viewCustomers()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers', compact('customers'));
    }

    // Category Management
   public function categories()
{
    $categories = Category::all();
    return view('admin.categories', compact('categories'));
}


    
    public function storeCategory(Request $request)
    {
        Category::create($request->all());
        return redirect('/admin/categories')->with('success','Category added successfully.');
    }

  public function updateCategory(Request $request, $id)
{
    $request->validate([
        'name' => 'required|unique:categories,name,'.$id,
        'description' => 'nullable'
    ]);

    $category = Category::findOrFail($id);
    $category->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect('/admin/categories')->with('success','Category updated successfully.');
}


    public function deleteCategory($id)
    {
        Category::destroy($id);
        return redirect('/admin/categories')->with('success','Category deleted successfully.');
    }

    // Vendor Management
    public function vendorManagement()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.vendors', compact('vendors'));
    }

    // Orders & Payments
    public function orders()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

   public function viewOrder($id)
{
    $order = Order::with('customer', 'products')->findOrFail($id);
    return view('admin.orders.view', compact('order'));
}



    public function products()
{
    $products = Product::with('category','vendor')->get();
    return view('admin.products.index', compact('products'));
}

public function createProduct()
{
    $categories = Category::all();
    return view('admin.products.create', compact('categories'));
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

    $data = [
        'vendor_id' => auth()->id(),
        'category_id' => $request->category_id,
        'name' => $request->name,
        'description' => $request->description,
        'long_description' => $request->long_description,
        'discount' => $request->discount ?? 0,
        'price' => $request->price,
        'stock' => $request->stock,
        'status' => 'approved'
    ];

    // Handle main image
    if ($request->hasFile('image')) {
        $imageName = time().'_'.$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images/products'), $imageName);
        $data['image'] = $imageName;
    }

    // Handle extra images
    foreach (['image1','image2','image3'] as $field) {
        if ($request->hasFile($field)) {
            $fileName = time().'_'.$request->file($field)->getClientOriginalName();
            $request->file($field)->move(public_path('images/products'), $fileName);
            $data[$field] = $fileName;
        }
    }

    Product::create($data);

    return redirect('/admin/products')->with('success','Product added successfully.');
}





public function editOrder($id)
{
    $order = Order::findOrFail($id);
    return view('admin.orders.edit', compact('order'));
}

public function updateOrder(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $request->validate([
        'status'          => 'required|string',
        'courier'         => 'nullable|string|max:255',
        'tracking_number' => 'nullable|string|max:255',
        'tracking_url'    => 'nullable|url',
    ]);

    $order->update($request->only('status', 'courier', 'tracking_number'));

    return redirect()->route('admin.orders.view', $order->id)
                     ->with('success', 'Order updated successfully.');
}









public function approveProduct($id)
{
    $product = Product::findOrFail($id);
    $product->status = 'approved';
    $product->save();

    return redirect('/admin/products')->with('success','Product approved successfully.');
}

public function rejectProduct($id)
{
    $product = Product::findOrFail($id);
    $product->status = 'rejected';
    $product->save();

    return redirect('/admin/products')->with('success','Product rejected successfully.');
}


public function deleteProduct($id)
{
    Product::destroy($id);
    return redirect('/admin/products')->with('success','Product deleted successfully.');
}




}


