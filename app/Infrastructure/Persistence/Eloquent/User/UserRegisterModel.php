<?php

namespace App\Infrastructure\Persistence\Eloquent\User;

use Illuminate\Database\Eloquent\Model;

class UserRegisterModel extends Model
{
    protected $table = 'user_register';

    protected $fillable = ['firstName', 'lastName', 'birthMonth', 'birthDay', 'birthYear', 'gender', 'email', 'password', 'image'];

    protected $hidden = ['password', 'remember_token'];
}
