<?php
// app/Models/User.php
namespace App\Models;


use App\Notifications\CustomResetPassword; // ✅ Correct path

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable

{
     use Notifiable;
protected $fillable = [
    'name', 'brand_name', 'email', 'phone', 'address',
    'brand_image', 'registration_license', 'nin_document',
    'password', 'role', 'status'
];





    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }




    protected $hidden = [
        'password', 'remember_token',
    ];


protected static function booted()
{
    static::created(function ($user) {
        // Create a cart automatically when a new user is registered
        $user->cart()->create();
    });
}

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

public function cart()
{
    return $this->hasOne(Cart::class, 'customer_id');
}


}
