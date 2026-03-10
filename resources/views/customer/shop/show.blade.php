<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body>
 @include('layouts.customer-header')
  

<section class="product-page">
  <div class="product-main">
    <!-- Product Gallery -->
    <div class="product-gallery">
      <div class="main-image">
        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
      </div>
      <div class="thumbnails">
        @if($product->image1)
          <img src="{{ asset('images/products/' . $product->image1) }}" alt="{{ $product->name }}">
        @endif
        @if($product->image2)
          <img src="{{ asset('images/products/' . $product->image2) }}" alt="{{ $product->name }}">
        @endif
        @if($product->image3)
          <img src="{{ asset('images/products/' . $product->image3) }}" alt="{{ $product->name }}">
        @endif
      </div>
    </div>

    <!-- Product Info -->
     <section class="product-info">
    <div class="product-details">
      <h1>{{ $product->name }}</h1>
      <p class="short">{{ $product->description }}</p>
      <p class="long">{{ $product->long_description }}</p>

      <div class="price-block">
        @if($product->discount > 0)
          <span class="old-price">₦{{ number_format($product->price, 2) }}</span>
          <span class="new-price">
            ₦{{ number_format($product->price * (1 - $product->discount/100), 2) }}
          </span>
        @else
          ₦{{ number_format($product->price, 2) }}
        @endif
      </div>

<form class="add-to-cart-form" data-id="{{ $product->id }}">
    @csrf
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">
    <button type="submit" class="buy-btn">
        <i class="fas fa-shopping-cart"></i> Add to Cart
    </button>
</form>


    </div>
  </div>

<!-- Reviews -->
<div class="reviews">
  <h3>Customer Reviews (Average: {{ number_format($product->averageRating(),1) }}/5)</h3>
  <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="review-form">
    @csrf
    <label for="rating">Rating:</label>
    <select name="rating" required>
      <option value="5">★★★★★</option>
      <option value="4">★★★★</option>
      <option value="3">★★★</option>
      <option value="2">★★</option>
      <option value="1">★</option>
    </select>
    <textarea name="review_text" placeholder="Write your review..."></textarea>
    <button type="submit">Submit Review</button>
  </form>

  @foreach($product->reviews as $review)
    <div class="review">
      <strong>{{ $review->customer->name }}</strong>
      <span>{{ str_repeat('★', $review->rating) }}</span>
      <p>{{ $review->review_text }}</p>
    </div>
  @endforeach
</div>
  
  </section>




<!-- Related Products -->
<section class="related-products">
  <h3>Related Products</h3>
  <div class="related-grid">
    @foreach($related as $item)
      <div class="related-card">
        <a href="{{ route('product.show', $item->id) }}">
          <img src="{{ asset('images/products/' . $item->image) }}" alt="{{ $item->name }}">
          <p>{{ $item->name }}</p>
        </a>
      </div>
    @endforeach
  </div>
</section>
 <script src="{{ asset('js/my.js') }}"></script>

   

</body>
</html>