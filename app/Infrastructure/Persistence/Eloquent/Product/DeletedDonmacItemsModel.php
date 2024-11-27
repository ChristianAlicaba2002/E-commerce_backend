<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class DeletedDonmacItemsModel extends Model
{
    protected $table = 'deleted_donmac';

    protected $fillable = ['product_id', 'name', 'price', 'description', 'image', 'created_at', 'updated_at'];
}
