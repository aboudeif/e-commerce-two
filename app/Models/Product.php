<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_variance;
use App\Models\Product_media;
use App\Models\Subcategory;
use App\Models\Favourite;


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
        return $this->hasMany(Product_variance::class);
    }
    public function product_media(){
        return $this->hasMany(Product_media::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function favourites(){
        return $this->hasMany(Favourite::class,'product_id');
    }
}
