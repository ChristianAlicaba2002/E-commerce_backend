<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserRegister extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'user_register';

    protected $fillable = ['firstName', 'lastName', 'birthMonth', 'birthDay', 'birthYear', 'gender', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];
}
