<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Category;
use App\Models\userAction;

class Subcategory extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    public function products(){
        return $this->hasMany(Product::class,'subcategory_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function userAction()
    {
        return $this->hasMany(UserAction::class,'user_id');
    }

}
