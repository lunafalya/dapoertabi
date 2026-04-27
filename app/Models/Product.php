<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category',
        'type',
        'price',
        'description',
        'file_path'
    ];



    public function items()
    {
        return $this->hasMany(Checkout::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class, 'product_id', 'id');
}

}
