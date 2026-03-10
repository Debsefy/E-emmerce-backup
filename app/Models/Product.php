<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'vendor_id',
    'category_id',
    'name',
    'description',
    'price',
    'stock',
    'status',
    'image',
    'image1',
    'image2',
    'image3',
    'long_description',
    'discount'
];




    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

     public function orders()
{
    return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }




}
