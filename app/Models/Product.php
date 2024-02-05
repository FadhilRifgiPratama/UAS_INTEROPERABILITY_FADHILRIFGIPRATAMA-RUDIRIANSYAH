<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function imageProduct()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
