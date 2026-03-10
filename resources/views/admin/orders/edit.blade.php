


<h1>Edit Order #{{ $order->id }}</h1>

<form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="status">Order Status</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <div class="form-group">
        <label for="courier">Courier</label>
        <input type="text" name="courier" id="courier" class="form-control" value="{{ $order->courier }}">
    </div>

<div class="form-group">
    <label for="tracking_number">Tracking Number</label>
    <input type="text" name="tracking_number" id="tracking_number"
           class="form-control" value="{{ $order->tracking_number }}">
</div>

<div class="form-group">
    <label for="courier">Courier</label>
    <select name="courier" id="courier" class="form-control">
        @foreach(config('couriers') as $courier => $url)
            <option value="{{ $courier }}" {{ $order->courier == $courier ? 'selected' : '' }}>
                {{ $courier }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="tracking_number">Tracking Number</label>
    <input type="text" name="tracking_number" id="tracking_number"
           class="form-control" value="{{ $order->tracking_number }}">
</div>


    <button type="submit" class="btn btn-primary">Update Order</button>
</form>
