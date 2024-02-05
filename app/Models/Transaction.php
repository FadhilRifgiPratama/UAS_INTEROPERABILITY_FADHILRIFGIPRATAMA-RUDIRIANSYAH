<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'town_city',
        'country',
        'postcode',
        'phone_number',
        'order_notes',
        'product_id',
        'quantity',
        'subtotal',
        'shipping',
        'payment_method',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
