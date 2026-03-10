<!-- resources/views/admin/customers.blade.php -->
<div class="page-header">
    <h1>Registered Customers</h1>
</div>

<div class="table-container">
    <table class="responsive-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td data-label="Name">{{ $customer->name }}</td>
                <td data-label="Email">{{ $customer->email }}</td>
                <td data-label="Status">
                    <span class="status {{ strtolower($customer->status) }}">
                        {{ $customer->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>
  .page-header {
    margin-bottom: 20px;
}

.page-header h1 {
    font-size: 24px;
    font-weight: 600;
    color: #111827;
}

.table-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    overflow-x: auto;
}
.responsive-table {
    width: 100%;
    border-collapse: collapse;
}

.responsive-table thead {
    background: #f3f4f6;
}

.responsive-table th,
.responsive-table td {
    padding: 15px;
    text-align: left;
    font-size: 14px;
}

.responsive-table th {
    font-weight: 600;
    color: #374151;
}

.responsive-table tbody tr {
    border-bottom: 1px solid #e5e7eb;
    transition: 0.2s ease;
}

.responsive-table tbody tr:hover {
    background: #f9fafb;
}
.status {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
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
@media (max-width: 768px) {

    .responsive-table thead {
        display: none;
    }

    .responsive-table,
    .responsive-table tbody,
    .responsive-table tr,
    .responsive-table td {
        display: block;
        width: 100%;
    }

    .responsive-table tr {
        margin-bottom: 15px;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .responsive-table td {
        text-align: right;
        padding: 10px 0;
        position: relative;
    }

    .responsive-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        font-weight: 600;
        color: #6b7280;
        text-align: left;
    }
}
</style>