<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class SpecialProductModel extends Model
{
    protected $table = 'special_product';
    
    protected $fillable = ['id', 'name', 'price','created_at', 'updated_at'];
}