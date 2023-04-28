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

    'first_name', 'last_name', 'mother_name','father_name','first_name', 'email', 'password','phone','location','roles_name','Status'
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
public function case()
{
    return $this->belongsToMany(Cases::class, 'lawyer_of_case');
}
public function case_1()
{
    return $this->belongsToMany(Cases::class, 'client_of_case');
}

}