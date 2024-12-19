<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    protected $table = 'branches';
    protected $fillable = [
        'branch_id',
        'branchname',
        'firstname',
        'lastname',
        'address',
        'phone_number',
        'email',
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
