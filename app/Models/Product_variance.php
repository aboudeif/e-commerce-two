<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderItem;

class Product_variance extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class,'product_variance_id');
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class,'product_variance_id');
    }

}
