<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    { 
         return
            [
              'id'=>$this->id,
              'judge'=>$this->judge,
              'title'=>$this->title,
              'Status'=>$this->Status,
              'case_number'=>$this->case_number,
              'enemy_Lawyer_name'=>$this->enemy_Lawyer_name,
              'enemy_Lawyer_phone'=>$this->enemy_Lawyer_phone,
              'enemy_Client_name'=>$this->enemy_Client_name,
              'enemy_Client_phone'=>$this->enemy_Client_phone,
              'case_Date'=>$this->case_Date,
              'case_room'=>$this->case_room,

            ];
        }
    
}
