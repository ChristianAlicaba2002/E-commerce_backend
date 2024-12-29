<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class DeletedDonmacItemsModel extends Model
{
    protected $table = 'deleted_donmac';

    protected $fillable = ['product_id', 'name', 'price', 'stock', 'description', 'image', 'branch_id', 'branch_name', 'created_at', 'updated_at'];
}
