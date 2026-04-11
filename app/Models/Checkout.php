<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Checkout extends Model
{

protected $table = 'checkouts'; // karena bukan plural
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
        
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function review()
{
    return $this->hasOne(Review::class, 'product_id', 'product_id')
        ->where('user_id', auth()->id());
}

}


