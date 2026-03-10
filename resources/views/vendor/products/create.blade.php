<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body>
    <h1>Upload Product</h1>
<form method="POST" action="/vendor/products/store" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Product Name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="number" name="price" placeholder="Price" required>
    <input type="number" name="stock" placeholder="Stock" required>
   <div class="form-group">
    <label for="discount">Discount (%)</label>
    <input type="number" name="discount" id="discount" class="form-control" value="0" min="0" max="100">
   </div>

    <select name="category_id" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

   <input type="file" name="image" required>

   
<div class="form-group">
    <label for="description">Short Description</label>
    <textarea name="description" class="form-control"></textarea>
</div>

<div class="form-group">
    <label for="long_description">Long Description</label>
    <textarea name="long_description" class="form-control"></textarea>
</div>

<div class="form-group">
    <label for="image">Main Image</label>
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <label for="image1">Extra Image 1</label>
    <input type="file" name="image1" class="form-control">
</div>

<div class="form-group">
    <label for="image2">Extra Image 2</label>
    <input type="file" name="image2" class="form-control">
</div>

<div class="form-group">
    <label for="image3">Extra Image 3</label>
    <input type="file" name="image3" class="form-control">
</div>

    <button type="submit">Upload</button>
</form>



</body>
</html>