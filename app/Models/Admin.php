<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admin';

    protected $fillable = ['admin', 'password'];

    protected $guard = 'admin';

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
