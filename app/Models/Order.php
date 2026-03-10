<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
// app/Models/Order.php
// public function products()
// {
//     return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
// }
public function customer()
{
    return $this->belongsTo(User::class, 'customer_id');
}

public function vendor()
{
    return $this->belongsTo(User::class, 'vendor_id');
}

public function products()
{
    return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}

public function getTrackingUrlAttribute()
{
    $courierLinks = config('couriers');

    if ($this->courier && $this->tracking_number && isset($courierLinks[$this->courier])) {
        return $courierLinks[$this->courier] . $this->tracking_number;
    }

    return null;
}



use HasFactory;

protected $fillable = [
    'customer_id',
    'vendor_id',
    'total_amount',
    'status',
    'shipping_cost',
    'receiver_name',
    'sender_mobile',
    'delivery_address',
    'delivery_country',
    'delivery_region',
    'delivery_city',
    'courier',
    'tracking_number',
];



}


