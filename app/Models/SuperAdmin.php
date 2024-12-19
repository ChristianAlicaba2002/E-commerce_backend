<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SuperAdmin extends Model
{
    //
    protected $table = 'super_admin';
    protected $fillable = ['admin','password'];
}
