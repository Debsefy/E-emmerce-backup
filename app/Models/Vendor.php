<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['user_id', 'business_name', 'logo', 'address', 'phone'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
