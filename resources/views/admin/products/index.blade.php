<!-- <h1>Manage Products</h1>
<a href="/admin/products/create">Upload New Product</a>

<table>
  <tr><th>Name</th><th>Category</th><th>Vendor</th><th>Price</th><th>Status</th><th>Action</th></tr>
  @foreach($products as $product)
  <tr>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
    <td>{{ $product->vendor->name ?? 'Admin' }}</td>
    <td>${{ $product->price }}</td>
    <td>{{ $product->status }}</td>
    <td>
      @if($product->status == 'pending')
    <a href="/admin/products/approve/{{ $product->id }}">Approve</a> |
    <a href="/admin/products/reject/{{ $product->id }}">Reject</a> |
@endif
<a href="/admin/products/delete/{{ $product->id }}">Delete</a>

    </td>
  </tr>
  @endforeach
</table> -->


<h1 class="page-title">Manage Products</h1>

<div class="top-actions">
    <a href="/admin/products/create" class="btn primary">
        Upload New Product
    </a>
</div>

<div class="table-card">
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Vendor</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr>
                    <td data-label="Name">{{ $product->name }}</td>
                    <td data-label="Category">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </td>
                    <td data-label="Vendor">
                        {{ $product->vendor->name ?? 'Admin' }}
                    </td>
                    <td data-label="Price">${{ $product->price }}</td>

                    <td data-label="Status">
                        <span class="status {{ strtolower($product->status) }}">
                            {{ $product->status }}
                        </span>
                    </td>

                    <td data-label="Action" class="actions">

                        @if($product->status == 'pending')
                            <a href="/admin/products/approve/{{ $product->id }}"
                               class="btn small success">Approve</a>

                            <a href="/admin/products/reject/{{ $product->id }}"
                               class="btn small warning">Reject</a>
                        @endif

                        <a href="/admin/products/delete/{{ $product->id }}"
                           class="btn small danger">
                            Delete
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
   TOP ACTION BUTTON
================================ */
.top-actions {
    margin-bottom: 20px;
}

/* ===============================
   TABLE CARD
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
   ADMIN TABLE
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
   ACTION BUTTON GROUP
================================ */
.actions {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

/* ===============================
   BUTTON SYSTEM
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

.btn.success {
    background: #16a34a;
    color: white;
}

.btn.warning {
    background: #f59e0b;
    color: white;
}

.btn.danger {
    background: #ef4444;
    color: white;
}

.btn:hover {
    opacity: 0.9;
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

.status.active {
    background: #d1fae5;
    color: #065f46;
}

.status.pending {
    background: #fef3c7;
    color: #92400e;
}

.status.rejected {
    background: #fee2e2;
    color: #991b1b;
}

/* ===============================
   MOBILE RESPONSIVE TABLE
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

    .actions {
        justify-content: flex-end;
    }
}
</style>