<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id',
        'task_name',
        'description',
        'start_date',
        'end_date',
        'status',
        'status_value',
        'user_name',
        'case_number'
    ];
    public function type()
    {
        return $this->belongsTo(Task_type::class);
    }

    public function users(){

        return $this->belongsToMany(User::class ,'user_of_task');
    }

    public function cases(){

        return $this->belongsToMany(Cases::class ,'case_of_task');
    }
}
