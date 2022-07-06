<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Product_variance;
use App\Models\User;


class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = [
        'user_id', 
        'product_id',
        'product_variance_id',
    ];
    
    protected $fillable = [
        'user_id', 
        'product_id', 
        'product_variance_id', 
        'price', 
        'quantity', 
        'reward',
        'discount',
        'shipping_fees',

    ];
    public $incrementing = false;
    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function product_variance(){
        return $this->belongsTo(Product_variance::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
