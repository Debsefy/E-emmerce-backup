<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
   @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body >
  <section>
  <!-- resources/views/vendor/products/index.blade.php -->
<h1>Manage Products</h1>
<a href="/vendor/products/create">Add New Product</a>

<table>
  <tr><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Action</th></tr>
  @foreach($products as $product)
  <tr>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
    <td>${{ $product->price }}</td>
    <td>{{ $product->stock }}</td>
    <td>
      <a href="/vendor/products/edit/{{ $product->id }}">Edit</a> |
      <a href="/vendor/products/delete/{{ $product->id }}">Delete</a>
    </td>
  </tr>
  @endforeach
</table>
</section>
</body>
</html>