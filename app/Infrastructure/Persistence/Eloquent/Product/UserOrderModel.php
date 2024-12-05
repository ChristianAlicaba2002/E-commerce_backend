<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Database\Eloquent\Model;

class UserOrderModel extends Model
{
    protected $table = 'user_order';

    protected $fillable = ['fullname', 'phoneNumber', 'address', 'message', 'product_id', 'name', 'description', 'quantity',  'payment', 'total_price',  'created_at', 'updated_at'];
}
