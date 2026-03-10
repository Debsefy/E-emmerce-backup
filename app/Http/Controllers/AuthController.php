<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ADMIN LOGIN
    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

   public function adminLogin(Request $request)
{
    $credentials = $request->only('email','password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } else {
            Auth::logout();
            return back()->with('error','You are not authorized as admin.');
        }
    }

    return back()->with('error','Invalid admin credentials.');
}


    // VENDOR LOGIN & REGISTRATION
    public function showVendorLogin()
    {
        return view('auth.vendor-login');
    }

   public function vendorLogin(Request $request)
{
    $credentials = $request->only('email','password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->role === 'vendor') {
            if ($user->status !== 'approved') {
                Auth::logout();
                return back()->with('error','Vendor account not approved yet.');
            }
            return redirect('/vendor/dashboard');
        }
    }

    return back()->with('error','Invalid vendor credentials.');
}

    public function showVendorRegister()
    {
        return view('auth.vendor-register');
    }

 public function vendorRegister(Request $request)
{
    $request->validate([
        'brand_name' => 'required|unique:users,brand_name',
        'business_email' => 'required|email|unique:users,email',
        'phone' => 'required',
        'address' => 'required',
        'brand_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'registration_license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
        'nin_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
        'password' => 'required|min:6|confirmed',
    ]);

    // Upload files
    $brandImagePath = $request->file('brand_image')->store('vendors/brand_images', 'public');
    $licensePath = $request->file('registration_license')->store('vendors/licenses', 'public');
    $ninPath = $request->file('nin_document')->store('vendors/nin', 'public');

    // ✅ Fill "name" with brand_name to satisfy DB requirement
    User::create([
        'name' => $request->brand_name, // <-- important fix
        'brand_name' => $request->brand_name,
        'email' => $request->business_email,
        'phone' => $request->phone,
        'address' => $request->address,
        'brand_image' => $brandImagePath,
        'registration_license' => $licensePath,
        'nin_document' => $ninPath,
        'password' => bcrypt($request->password),
        'role' => 'vendor',
        'status' => 'pending', // admin must approve
    ]);

    return redirect('/login/vendor')->with('success', 'Vendor account created. Awaiting admin approval.');
}

   // CUSTOMER LOGIN & REGISTRATION
    public function showCustomerLogin()
    {
        return view('auth.customer-login');
    }

    public function customerLogin(Request $request)
    {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'customer') {
                return redirect('/customer/dashboard');
            }
        }

        return back()->with('error','Invalid customer credentials.');
    }

    public function showCustomerRegister()
    {
        return view('auth.customer-register');
    }

protected function authenticated(Request $request, $user)
{
    if (!$user->cart) {
        $user->cart()->create();
    }
}


    public function mergeGuestCart($customer)
{
    $sessionCart = session()->get('cart', []);

    if (!empty($sessionCart)) {
        $cart = Cart::firstOrCreate(['customer_id' => $customer->id]);

        foreach ($sessionCart as $productId => $quantity) {
            $cart->products()->syncWithoutDetaching([
                $productId => ['quantity' => $quantity]
            ]);
        }

        // Clear guest cart
        session()->forget('cart');
    }
    
}




    public function customerRegister(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role'=>'customer',
            'status'=>'approved'
        ]);

        return redirect('/login/customer')->with('success','Customer account created. You can log in now.');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
