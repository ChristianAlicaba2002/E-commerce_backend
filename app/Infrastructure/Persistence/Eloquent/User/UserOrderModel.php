<?php

namespace App\Infrastructure\Persistence\Eloquent\User;

use Illuminate\Database\Eloquent\Model;

class UserOrderModel extends Model
{
    protected $table = 'user_order';

    protected $fillable = ['fullname', 'phoneNumber', 'address', 'message', 'product_id', 'name', 'description', 'quantity',  'payment', 'total_price', 'status', 'tracking_number', 'created_at', 'updated_at'];
}
