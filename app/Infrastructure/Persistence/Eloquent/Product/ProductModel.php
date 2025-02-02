<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'description',
        'category',
        'image',
        'branch_id',
        'branch_name',
        'section',
        'created_at',
        'updated_at',
    ];
}
