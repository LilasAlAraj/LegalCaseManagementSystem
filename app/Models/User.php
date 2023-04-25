<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
use HasRoles;
use Notifiable;
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [

    'name', 'email', 'password','phone','location','roles_name','Status'
];
/**
* The attributes that should be hidden for arrays.
*
* @var array
*/
protected $hidden = [
'password', 'remember_token',
];
/**
* The attributes that should be cast to native types.
*
* @var array
*/
protected $casts = [
    'email_verified_at' => 'datetime',
'roles_name' => 'array',

];
}