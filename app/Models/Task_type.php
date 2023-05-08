<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_type_name'
    ];

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
