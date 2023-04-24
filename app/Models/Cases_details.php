<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_Cases',
        'case_number',
        'Status',
        'decision',
        'facts',
        'legal_discussion',
        'verdict'
    ];
}
