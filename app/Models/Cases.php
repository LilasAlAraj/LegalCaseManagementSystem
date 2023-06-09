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
        'case_number',
        'cases_Date',
        'title',
        'court_id',
        'case_room',
        'judge',
        'judge_side',
        'Status',
        'Value_Status',
<<<<<<< HEAD
        'enemy_Lawyer_name',
        'enemy_Lawyer_phone',
        'enemy_Client_name',
        'enemy_Client_phone'
=======
        'enemyLawyer_name',
        'enemy_lawyer_phone',
        'enemyClient_name',
        'enemyClient_phone',

        //'task_id'
>>>>>>> 5c601ecfd05b487c3837da232c11ad0be0aabae8
    ];

    public function sessions()
    {
        return $this->hasMany(Sessions::class);
    }
    public function desicions()
    {
        return $this->hasMany(Desicions::class);
    }
    public function enemy_lawyers()
    {
        return $this->belongsToMany(Enemy_Lawyers::class,'enemy_lawyer_of_cases');
    }
    public function enemy_clients()
    {
        return $this->belongsToMany(Enemy_Clients::class,'enemy_client_of_cases');
    }
    public function user()
    {
        return $this->belongsToMany(User::class, 'lawyer_of_case');
    }
    public function user_1()
    {
        return $this->belongsToMany(User::class, 'client_of_case');
    }

    public function tasks(){

        return $this->belongsToMany(tasks::class ,'case_of_task');
    }
    
}
