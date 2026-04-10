<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'urban_village',
        'address',
        'notes',
        'payment_method',
        'total'
    ];

    public function items()
    {
        return $this->hasMany(Checkout::class);
    }
}
