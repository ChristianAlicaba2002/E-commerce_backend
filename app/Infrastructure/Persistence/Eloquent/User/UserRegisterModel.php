<?php

namespace App\Infrastructure\Persistence\Eloquent\User;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRegisterModel extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_register';

    protected $fillable = ['firstName', 'lastName', 'birthMonth', 'birthDay', 'birthYear', 'gender', 'email', 'password', 'image'];

    protected $hidden = ['password', 'remember_token'];
}
