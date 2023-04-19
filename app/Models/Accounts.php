<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accounts extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'First_Name',
        'Middle_Name',
        'Last_Name',
        'Location',
        'Phone_Number',
        'Email',
        'Password'

    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    protected $casts = [
        'Email_verified_at' => 'datetime',
    ];
    protected $dates = ['deleted_at'];
}
