<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'don_mac';

    protected $fillable = ['product_id', 'name', 'price', 'image', 'description', 'branch_id', 'branch_name', 'created_at', 'updated_at'];
}
