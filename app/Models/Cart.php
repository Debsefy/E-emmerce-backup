<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = ['customer_id'];

public function customer()
{
    return $this->belongsTo(User::class, 'customer_id');
}

public function products()
{
    return $this->belongsToMany(Product::class, 'cart_product', 'cart_id', 'product_id')
                ->withPivot('quantity')
                ->withTimestamps();
}

  }
    

  