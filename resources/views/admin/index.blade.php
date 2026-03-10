<!-- resources/views/admin/orders/index.blade.php -->
<!-- <h1>Orders</h1>
<table>
  <tr><th>ID</th><th>Customer</th><th>Vendor</th><th>Total</th><th>Status</th><th>Action</th></tr>
  @foreach($orders as $order)
  <tr>
    <td>{{ $order->id }}</td>
    <td>{{ $order->user_id }}</td>
    <td>{{ $order->vendor_id }}</td>
    <td>${{ $order->total_amount }}</td>
    <td>{{ $order->status }}</td>
    <td><a href="/admin/orders/view/{{ $order->id }}">View</a></td>
  </tr>
  @endforeach
</table> -->
<h1 class="page-title">Orders</h1>

<div class="table-card">
  <div class="table-container">
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Customer</th>
          <th>Vendor</th>
          <th>Total</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach($orders as $order)
        <tr>
          <td data-label="ID">#{{ $order->id }}</td>
          <td data-label="Customer">{{ $order->user_id }}</td>
          <td data-label="Vendor">{{ $order->vendor_id }}</td>
          <td data-label="Total">${{ $order->total_amount }}</td>
          <td data-label="Status">
            <span class="status {{ strtolower($order->status) }}">
              {{ $order->status }}
            </span>
          </td>
          <td data-label="Action">
            <a href="/admin/orders/view/{{ $order->id }}" class="btn small primary">
              View
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<style>
  /* ===============================
   PAGE TITLE
================================ */
.page-title {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 20px;
  color: #111827;
}

/* ===============================
   TABLE WRAPPER
================================ */
.table-card {
  background: #ffffff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.table-container {
  overflow-x: auto;
}

/* ===============================
   TABLE DESIGN
================================ */
.admin-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}

.admin-table thead {
  background: #f3f4f6;
}

.admin-table th,
.admin-table td {
  padding: 14px 15px;
  text-align: left;
}

.admin-table th {
  font-weight: 600;
  color: #374151;
}

.admin-table tbody tr {
  border-bottom: 1px solid #e5e7eb;
  transition: 0.2s ease;
}

.admin-table tbody tr:hover {
  background: #f9fafb;
}

/* ===============================
   BUTTON
================================ */
.btn {
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 12px;
  text-decoration: none;
  display: inline-block;
  transition: 0.2s ease;
}

.btn.primary {
  background: #2563eb;
  color: white;
}

.btn.primary:hover {
  background: #1e40af;
}

/* ===============================
   STATUS BADGES
================================ */
.status {
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
  display: inline-block;
}

.status.completed {
  background: #d1fae5;
  color: #065f46;
}

.status.pending {
  background: #fef3c7;
  color: #92400e;
}

.status.cancelled {
  background: #fee2e2;
  color: #991b1b;
}

.status.processing {
  background: #dbeafe;
  color: #1e3a8a;
}

/* ===============================
   MOBILE RESPONSIVE
================================ */
@media (max-width: 768px) {

  .admin-table thead {
    display: none;
  }

  .admin-table,
  .admin-table tbody,
  .admin-table tr,
  .admin-table td {
    display: block;
    width: 100%;
  }

  .admin-table tr {
    margin-bottom: 15px;
    background: #ffffff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
  }

  .admin-table td {
    text-align: right;
    position: relative;
    padding: 8px 0;
  }

  .admin-table td::before {
    content: attr(data-label);
    position: absolute;
    left: 0;
    font-weight: 600;
    color: #6b7280;
    text-align: left;
  }
}
</style>