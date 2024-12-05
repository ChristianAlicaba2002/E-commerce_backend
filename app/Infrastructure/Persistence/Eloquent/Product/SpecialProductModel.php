<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class SpecialProductModel extends Model
{
    protected $table = 'special_product';
    
    protected $fillable = ['product_id','name', 'price','stock','description','category','image','created_at', 'updated_at'];
}