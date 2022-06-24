<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_variance;
use App\Models\Product_media;
use App\Models\Subcategory;
use App\Models\Favourite;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\UserReport;


class Product extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'name',
        'description',
        'subcategory_id',
    ];

    public function product_variances(){
        return $this->hasMany(Product_variance::class,'product_id');
    }
    public function product_media(){
        return $this->hasMany(Product_media::class,'product_id');
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function favourites(){
        return $this->hasMany(Favourite::class,'product_id');
    }
    public function carts(){
        return $this->hasMany(Cart::class,'product_id');
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class,'product_id');
    }

    public function userActions()
    {
        return $this->hasMany(UserAction::class,'product_id');
    }

    public function userReports(){
        return $this->hasMany(UserReport::class,'product_id');
    }
    
}
