<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

   @vite(['resources/css/style.css', 'resources/js/my.js'])

</head>
<body>

 @include('layouts.header')


<section class="hero-section">
  <!-- Sidebar Categories -->
  <aside class="categories">
  <ul>
    @foreach($categories as $category)
      <li>
        <a href="{{ route('shop.category', $category->id) }}">
          @if($category->name === 'galdgets')
            <i class="fas fa-blender"></i>
          @elseif($category->name === 'Phones & Tablets')
            <i class="fas fa-mobile-alt"></i>
          @elseif($category->name === 'Fashion')
            <i class="fas fa-tshirt"></i>
          @elseif($category->name === 'Electronics')
            <i class="fas fa-tv"></i>
          @elseif($category->name === 'Supermarket')
            <i class="fas fa-shopping-basket"></i>
          @else
            <i class="fas fa-tag"></i>
          @endif
          {{ $category->name }}
        </a>
      </li>
    @endforeach
  </ul>

        <div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search products, brands and categories" required>
        <button type="submit">Search</button>
    </form>
</div>
</aside>

  <!-- Hero Slider -->
  <div class="hero-slider">
    <div class="slide active">
       <img src="{{ asset('/image/20260222_142558.jpg') }}" alt="Main Banner">
      <div class="hero-text">
        <h2>Tech Week</h2>
        <p>Up to 65% Off</p>
        <a href="#" class="hero-btn">Discover</a>
      </div>
    </div>
    <div class="slide">
       <img src="{{ asset('/image/20260222_142558.jpg') }}" alt="Main Banner">
      <div class="hero-text">
        <h2>New Arrivals</h2>
        <p>Fresh styles for you</p>
        <a href="#" class="hero-btn">Shop Now</a>
      </div>
    </div>
    <div class="slide">
       <img src="{{ asset('/image/20260222_142558.jpg') }}" alt="Main Banner">
      <div class="hero-text">
        <h2>Flash Deals</h2>
        <p>Limited stock only</p>
        <a href="#" class="hero-btn">Grab Deal</a>
      </div>
    </div>
    <div class="slide">
       <img src="{{ asset('/image/20260222_142558.jpg') }}" alt="Main Banner">
      <div class="hero-text">
        <h2>Smart Gadgets</h2>
        <p>Upgrade your tech</p>
        <a href="#" class="hero-btn">Explore</a>
      </div>
    </div>
    <div class="slide">
       <img src="{{ asset('/image/20260222_142558.jpg') }}" alt="Main Banner">
      <div class="hero-text">
        <h2>Home Essentials</h2>
        <p>Comfort at best price</p>
        <a href="#" class="hero-btn">Shop Now</a>
      </div>
    </div>
  </div>

  <!-- Quick Links -->
  <div class="quick-links">
    <div class="link-card"><i class="fas fa-phone"></i><p>Call to Order <br>089335437752</p></div>
    
    <div class="link-card"><i class="fas fa-store"><a href="/login/vendor"></i><p>Sell on Shop</p></a></div>
    <div class="link-card"><i class="fas fa-box"></i><p>Send Packages <br>089335437752</p></div>
    <div class="link-card"><i class="fas fa-users"> <a class="admin-link" href="/login/admin">join force</a></i><p>Join Force</p></div>
  </div>
</section>



<!-- Trust Section -->
<section class="trust">
  <div class="trust-item">
    <i class="fas fa-shipping-fast"></i>
    <h3>Free Shipping</h3>
    <p>On all orders above ₦50,000</p>
  </div>
  <div class="trust-item">
    <i class="fas fa-headset"></i>
    <h3>24/7 Support</h3>
    <p>We’re here anytime you need us</p>
  </div>
  <div class="trust-item">
    <i class="fas fa-undo"></i>
    <h3>Easy Returns</h3>
    <p>30-day hassle-free returns</p>
  </div>
  <div class="trust-item">
    <i class="fas fa-lock"></i>
    <h3>Secure Payment</h3>
    <p>Your transactions are safe with us</p>
  </div>
</section>



   

<!-- 
    <h1>Shop Products</h1> -->
<section class="product-section">
    <h2>all product</h2>
    <div class="product-grid">
                @foreach($products as $product)
            <div class="product-card deal">
                <a href="{{ route('product.guestdetail', $product->id) }}">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                </a>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-desc">{{ $product->description }}</p>
                    <div class="price-box">
       <p>₦{{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
                <form class="add-to-cart-form" data-id="{{ $product->id }}">
                    @csrf
                    <button type="submit" class="buy-btn">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</section>

<section class="product-section">
    <h2>Limited Stock Deals | Up to 60% Off</h2>
    <div class="product-grid">
              @foreach($deals as $product)
            <div class="product-card deal">
                <a href="{{ route('product.guestdetail', $product->id) }}">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                </a>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-desc">{{ $product->description }}</p>
                    <div class="price-box">
                        <span class="new-price">₦{{ number_format($product->price * (1 - $product->discount/100), 2) }}</span>
                        <span class="old-price">₦{{ number_format($product->price, 2) }}</span>
                        <span class="discount">-{{ $product->discount ?? 0 }}%</span>
                    </div>
                </div>
                <form class="add-to-cart-form" data-id="{{ $product->id }}">
                    @csrf
                    <button type="submit" class="buy-btn">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</section>
 

   <section class="product-section">
    <h2>Recommended</h2>
    <div class="product-grid">
         @foreach($recommended as $product)
            <div class="product-card deal">
                <a href="{{ route('product.guestdetail', $product->id) }}">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                </a>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-desc">{{ $product->description }}</p>
                    <div class="price-box">
                                     <p>₦{{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
                <form class="add-to-cart-form" data-id="{{ $product->id }}">
                    @csrf
                    <button type="submit" class="buy-btn">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</section>



    





   
 @include('layouts.footer')

</body>
</html>