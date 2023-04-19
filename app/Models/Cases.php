<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cases extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'cases_number',
        'court_Name',
        'room',
        'base_Number',
        'claimant_Name',
        'defendant_Name',
        'claimant_Lawyer',
        'defendant_Lawyer',
        'cases_Date',
        'cases_Subject'
    ];
    protected $dates = ['deleted_at'];
}
