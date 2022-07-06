<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Favourite extends Model
{
    use HasFactory;

    protected $primaryKey = [
        'user_id', 
        'product_id'
    ];
    
    protected $fillable = [
        'user_id', 
        'product_id'
    ];

    public $incrementing = false;
    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
