<h1>Upload Product</h1>
<!-- <form method="POST" action="/admin/products/store" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Product Name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="number" name="price" placeholder="Price" required>
    <input type="number" name="stock" placeholder="Stock" required>

    <select name="category_id" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <input type="file" name="image" required>

    <button type="submit">Upload</button>
</form> -->


<h1 class="page-title">Add New Product</h1>

<div class="form-card">

    <form method="POST"
          action="/admin/products/store"
          enctype="multipart/form-data"
          class="product-form">

        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name"
                       placeholder="Enter product name" required>
            </div>

            <div class="form-group full-width">
                <label>Description</label>
                <textarea name="description"
                          placeholder="Enter product description"></textarea>
            </div>

            <div class="form-group">
    <label for="long_description">Long Description</label>
    <textarea name="long_description" class="form-control"></textarea>
</div>

            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price"
                       placeholder="0.00" required>
            </div>

            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock"
                       placeholder="Available stock" required>
            </div>
            <div class="form-group">
    <label for="discount">Discount (%)</label>
    <input type="number" name="discount" id="discount" class="form-control" value="0" min="0" max="100">
</div>


            <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Product Image</label>
                <input type="file" name="image" required>
            </div>

            <div class="form-group">
    <label for="image1">Extra Image 1</label>
    <input type="file" name="image1" class="form-control" required>
</div>

<div class="form-group">
    <label for="image2">Extra Image 2</label>
    <input type="file" name="image2" class="form-control" required>
</div>

<div class="form-group">
    <label for="image3">Extra Image 3</label>
    <input type="file" name="image3" class="form-control" required>
</div>

        </div>

        <button type="submit" class="btn primary">
            Upload Product
        </button>

    </form>

</div>









<style>
    .form-card {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}
.product-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}
.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 6px;
    font-size: 14px;
    font-weight: 500;
    color: #374151;
}

.form-group input,
.form-group textarea,
.form-group select {
    padding: 10px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 14px;
    outline: none;
    transition: 0.2s ease;
}

.form-group textarea {
    min-height: 100px;
    resize: vertical;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
}
.btn {
    padding: 10px 16px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    border: none;
    transition: 0.2s ease;
}

.btn.primary {
    background: #2563eb;
    color: white;
}

.btn.primary:hover {
    background: #1e40af;
}
@media (min-width: 768px) {
    .form-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .full-width {
        grid-column: span 2;
    }
}

@media (min-width: 1024px) {
    .form-card {
        max-width: 900px;
    }
}
</style>