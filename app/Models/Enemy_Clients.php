<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enemy_Clients extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'number_phone',
        'case_id'
    ];
    protected $dates = ['deleted_at'];
    
    public function case()
    {
        return $this->belongsTo(Cases::class);
    }
}