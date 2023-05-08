<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [

    'first_name', 'last_name', 'mother_name','father_name','first_name', 'email', 'password','phone','location','roles_name','Status','birth_date','birth_place',
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


 /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
public function case()
{
    return $this->belongsToMany(Cases::class, 'lawyer_of_case');
}
public function case_1()
{
    return $this->belongsToMany(Cases::class, 'client_of_case');
}


}