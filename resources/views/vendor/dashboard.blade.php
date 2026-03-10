<!DOCTYPE html>
<html>
<head>
    <title>Vendor Dashboard</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body class="vendor-body">
    @include('layouts.customer-header')
<button class="sidebar-toggle" onclick="document.querySelector('.vendor-sidebar').classList.toggle('active')">
  ☰ Menu
</button>

    <div class="vendor-dashboard">
        <!-- Sidebar -->
        <aside class="vendor-sidebar">
            <h2 class="sidebar-title">Vendor Panel</h2>
            <nav class="sidebar-nav">
                <a href="/vendor/dashboard" class="sidebar-link">Overview</a>
                <a href="/vendor/products" class="sidebar-link">Manage Products</a>
                <a href="/vendor/orders" class="sidebar-link">Order List</a>
                <a href="{{ route('vendor.pos') }}" class="sidebar-link">Sell on POS</a> <!-- NEW -->
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="vendor-main">
            <section class="vendor-overview">
                <div class="vendor-card">
                    <h2 class="card-value">{{ $totalProducts }}</h2>
                    <p class="card-label">Total Products</p>
                </div>
                <div class="vendor-card">
                    <h2 class="card-value">{{ $totalOrders }}</h2>
                    <p class="card-label">Total Orders</p>
                </div>
                <div class="vendor-card">
                    <h2 class="card-value">${{ $totalSales }}</h2>
                    <p class="card-label">Total Sales</p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
