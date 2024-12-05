<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class UserAPI extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'user_api';

    protected $fillable = [
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
