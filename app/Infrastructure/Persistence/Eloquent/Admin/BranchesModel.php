<?php

namespace App\Infrastructure\Persistence\Eloquent\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class BranchesModel extends Model
{
    use HasApiTokens,HasFactory,Notifiable;

    protected $table = 'branches';

    protected $fillable = [
        'branch_id',
        'branch_name',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'email',
        'password',
        'status',
        'created_at',
        'updated_at',
    ];
}
