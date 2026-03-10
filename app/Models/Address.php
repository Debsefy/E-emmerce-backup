<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'customer_id', 'street', 'city', 'state', 'postal_code', 'country'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
