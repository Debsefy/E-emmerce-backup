<!-- resources/views/customer/dashboard.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
</head>
<body class="customerd">
    @include('layouts.customer-header')

 

    <div class="customer-dashboard">
           <button class="sidebar-toggle" onclick="document.querySelector('.customersidebar').classList.toggle('active')">
  ☰ Menu
</button>
        <!-- Sidebar -->
        <div class="customersidebar">
            <h1>{{ Auth::user()->name }}</h1>
            <a href="{{ route('customer.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('customer.orders') }}"><i class="fas fa-box"></i> My Orders</a>
            <a href="{{ route('shop.index') }}"><i class="fas fa-store"></i> Shop Products</a>
            <a href="{{ route('customer.profile.edit') }}"><i class="fas fa-user"></i> Edit Profile</a>
            <a href="{{ route('customer.addresses.index') }}"><i class="fas fa-map-marker-alt"></i> Saved Addresses</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
        

        <!-- Main Content -->
         
        <div class="customermain-content">
            


            <!-- Profile Details -->
            <div class="customersection">
                <h2><i class="fas fa-id-card"></i> Profile Details</h2>
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>

            <!-- Saved Addresses -->
            <div class="customersection">
                <h2><i class="fas fa-map"></i> Saved Addresses</h2>
                @forelse($addresses as $address)
                    <p>{{ $address->street }}, {{ $address->city }}, {{ $address->country }}</p>
                @empty
                    <p>No saved addresses yet.</p>
                @endforelse
                <p><a href="{{ route('customer.addresses.create') }}"><i class="fas fa-plus"></i> Add New Address</a></p>
            </div>

            <!-- Recent Orders -->
            <div class="customersection">
                <h2><i class="fas fa-shopping-cart"></i> Recent Orders</h2>
                @forelse($orders as $order)
                    <li>
                        <i class="fas fa-receipt"></i> Order #{{ $order->id }} - 
                        Status: {{ $order->status }} - 
                        Total: ₦{{ number_format($order->total_amount, 2) }}
                    </li>
                @empty
                    <p>You have no recent orders.</p>
                @endforelse
            </div>

            <!-- Order Tracking -->
            <div class="customersection">
                <h2><i class="fas fa-truck"></i> Order Tracking</h2>
                @foreach($orders as $order)
                    <p>
                        <i class="fas fa-barcode"></i> Order #{{ $order->id }} - Tracking #: {{ $order->tracking_number ?? 'Not available' }}
                        <a href="{{ route('customer.orders.track', $order->id) }}"><i class="fas fa-location-arrow"></i> Track Order</a>
                    </p>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
