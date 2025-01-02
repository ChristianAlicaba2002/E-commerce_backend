<?php

namespace App\Infrastructure\Persistence\Eloquent\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserRegisterModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_register';

    protected $fillable = ['firstName', 'lastName', 'birthMonth', 'birthDay', 'birthYear', 'gender', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];
}
