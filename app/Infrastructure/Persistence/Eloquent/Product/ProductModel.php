<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'don_mac';
    protected $fillable = ['id', 'name', 'price','image','description','created_at', 'updated_at'];
}
