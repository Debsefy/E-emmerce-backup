<!-- resources/views/admin/categories.blade.php -->
<!-- <h1>Category Management</h1>

<form method="POST" action="/admin/categories/store">
  @csrf
  <input type="text" name="name" placeholder="Category Name" required>
  <input type="text" name="description" placeholder="Description">
  <button type="submit">Add Category</button>
</form>

<table>
  <tr><th>Name</th><th>Description</th><th>Action</th></tr>
  @foreach($categories as $category)
  <tr>
    <td>{{ $category->name }}</td>
    <td>{{ $category->description }}</td>
    <td>
      <form method="POST" action="/admin/categories/update/{{ $category->id }}">
        @csrf
        <input type="text" name="name" value="{{ $category->name }}">
        <input type="text" name="description" value="{{ $category->description }}">
        <button type="submit">Update</button>
      </form>
      <a href="/admin/categories/delete/{{ $category->id }}">Delete</a>
    </td>
  </tr>
  @endforeach
</table> -->

<div class="page-header">
    <h1>Category Management</h1>
</div>

<div class="category-wrapper">

    <!-- Add Category Form -->
    <div class="form-card">
        <h2>Add New Category</h2>

        <form method="POST" action="/admin/categories/store" class="category-form">
            @csrf

            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" placeholder="Enter category name" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" placeholder="Enter description">
            </div>

            <button type="submit" class="btn primary">Add Category</button>
        </form>
    </div>

    <!-- Category Table -->
    <div class="table-card">
        <h2>All Categories</h2>

        <div class="table-container">
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td data-label="Name">{{ $category->name }}</td>
                        <td data-label="Description">{{ $category->description }}</td>
                        <td data-label="Action">

                            <form method="POST"
                                  action="/admin/categories/update/{{ $category->id }}"
                                  class="inline-form">
                                @csrf
                                <input type="text" name="name"
                                       value="{{ $category->name }}">
                                <input type="text" name="description"
                                       value="{{ $category->description }}">
                                <button type="submit"
                                        class="btn small warning">
                                    Update
                                </button>
                            </form>

                            <a href="/admin/categories/delete/{{ $category->id }}"
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

</div>

<style>
  .category-wrapper {
    display: grid;
    gap: 30px;
}

.form-card,
.table-card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.form-card h2,
.table-card h2 {
    margin-bottom: 20px;
    font-size: 18px;
}

.category-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 6px;
    font-size: 14px;
    color: #374151;
}

.category-form input {
    padding: 10px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    outline: none;
}

.category-form input:focus {
    border-color: #2563eb;
}
.btn {
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    text-decoration: none;
    border: none;
    display: inline-block;
    transition: 0.2s ease;
}

.btn.primary {
    background: #2563eb;
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

.btn.small {
    font-size: 12px;
    padding: 6px 10px;
}

.btn:hover {
    opacity: 0.9;
}
.responsive-table {
    width: 100%;
    border-collapse: collapse;
}

.responsive-table th,
.responsive-table td {
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

.responsive-table thead {
    background: #f3f4f6;
}

.responsive-table tbody tr {
    border-bottom: 1px solid #e5e7eb;
}

.inline-form {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 8px;
}

.inline-form input {
    padding: 6px;
    font-size: 12px;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
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
        padding: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .responsive-table td {
        text-align: right;
        position: relative;
        padding: 8px 0;
    }

    .responsive-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        font-weight: 600;
        color: #6b7280;
    }

    .inline-form {
        flex-direction: column;
    }
}
</style>