<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'description',
        'delay_date',
        'delay_reasons',
        'case_id'
    ];

    public function case()
    {
        return $this->belongsTo(Cases::class);
    }
}
