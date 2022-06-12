<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $primaryKey = ['user_id', 'product_id'];
    public $incrementing = false;
    protected $fillable = ['user_id', 'product_id'];
    public $timestamps = false;
    use HasFactory;
}
