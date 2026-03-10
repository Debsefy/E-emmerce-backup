<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function showRegisterForm()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer',
        ]);

        return redirect('/login/customer')->with('success', 'Account created successfully.');
    }

    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            return redirect('/customer/dashboard');
        }
        return back()->with('error','Invalid credentials');
    }

     public function dashboard()
    {
        // Fetch orders for the logged-in customer
        $orders = Order::where('customer_id', auth()->id())
                       ->orderBy('created_at', 'desc')
                       ->take(5)
                       ->get();

        // Fetch saved addresses for the logged-in customer
        $addresses = Address::where('customer_id', auth()->id())->get();

        return view('customer.dashboard', compact('orders', 'addresses'));
    }

}

