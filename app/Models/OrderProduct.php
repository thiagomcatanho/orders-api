<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $entity) {
            $product = Product::find($entity->product_id);

            $entity->product_name = $product->name;
            $entity->product_price = $product->price;

            return $entity;
        });
    }
}
