<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'surname',
        'role',
        'department_id'
    ];

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
