<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
 @vite(['resources/css/style.css', 'resources/js/my.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    

    <div class="admin-dashboard">
    <!-- Toggle button (visible on mobile) -->
    <div class="sidebar-toggle">☰ Menu</div>

    <div class="sidebar">
        <h2 style="padding:15px;">Admin Panel</h2>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/approve-vendors">Approve Vendors</a>
        <a href="/admin/customers">View Customers</a>
        <a href="/admin/categories">Category Management</a>
        <a href="/admin/vendors">Vendor Management</a>
        <a href="/admin/orders">Order And Payment Management</a>
        <a href="/admin/products">Product Management</a>
    </div>

    <div class="content">
        <h1>Welcome, Admin</h1>
        <div class="card">
            <h2>{{ $totalVendors }}</h2>
            <p>Total Vendors</p>
        </div>
        <div class="card">
            <h2>{{ $totalCustomers }}</h2>
            <p>Total Customers</p>
        </div>
        <div class="card">
            <h2>${{ $totalSales }}</h2>
            <p>Total Sales</p>
        </div>
    </div>
</div>
<script>
  const toggle = document.querySelector('.sidebar-toggle');
  const sidebar = document.querySelector('.sidebar');

  toggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
  });
</script>

</body>
</html>
