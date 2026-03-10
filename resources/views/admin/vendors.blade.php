<!-- resources/views/admin/vendors.blade.php -->
<!-- <h1>Vendor Management</h1>
<table>
  <tr><th>Name</th><th>Email</th><th>Status</th></tr>
  @foreach($vendors as $vendor)
  <tr>
    <td>{{ $vendor->name }}</td>
    <td>{{ $vendor->email }}</td>
    <td>{{ $vendor->status }}</td>
  </tr>
  @endforeach
</table> -->

<h1 class="page-title">Vendor Management</h1>

<div class="table-card">
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($vendors as $vendor)
                <tr>
                    <td data-label="Name">{{ $vendor->name }}</td>
                    <td data-label="Email">{{ $vendor->email }}</td>
                    <td data-label="Status">
                        <span class="status {{ strtolower($vendor->status) }}">
                            {{ $vendor->status }}
                        </span>
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
   TABLE CARD CONTAINER
================================ */
.table-card {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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

.status.inactive {
    background: #fee2e2;
    color: #991b1b;
}

.status.pending {
    background: #fef3c7;
    color: #92400e;
}

/* ===============================
   MOBILE RESPONSIVENESS
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
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
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
