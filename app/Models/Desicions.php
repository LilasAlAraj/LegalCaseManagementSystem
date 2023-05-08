<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desicions extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'date',
        'description',
        'case_id',
    ];

    public function case()
    {
        return $this->belongsTo(Cases::class,'case_id', 'id');
    }
}
