<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enemy_Lawyers extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'enemy_Lawyer_name',
        'enemy_Lawyer_phone',
        'case_id'
    ];
    protected $dates = ['deleted_at'];
    
    public function case()
    {
        return $this->belongsToMany(Cases::class,'enemy_lawyer_of_cases');
    }
}
