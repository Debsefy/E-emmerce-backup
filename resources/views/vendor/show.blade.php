
<h1>{{ $vendor->business_name }}</h1>
<img src="{{ $vendor->logo }}" alt="{{ $vendor->business_name }}" style="max-width:150px;">
<p>{{ $vendor->address }}</p>
<p>Contact: {{ $vendor->phone }}</p>

<h2>Products</h2>
<div class="row">
    @foreach($vendor->products as $product)
        <div class="col-md-3">
            <div class="card">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top">
                <div class="card-body">
                    <h5>{{ $product->name }}</h5>
                    <p>₦{{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">View Product</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

