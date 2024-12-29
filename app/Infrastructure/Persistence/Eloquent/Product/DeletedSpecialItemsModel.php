<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class DeletedSpecialItemModel extends Model
{
    protected $table = 'deleted_special';

    protected $fillable = ['product_id', 'name', 'price', 'stock', 'description', 'category', 'image', 'branch_id', 'branch_name', 'created_at', 'updated_at'];
}
