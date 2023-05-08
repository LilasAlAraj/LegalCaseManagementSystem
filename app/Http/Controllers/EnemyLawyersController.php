<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Enemy_Lawyers;

use Illuminate\Http\Request;

class EnemyLawyersController extends Controller
{
    public function index()
    {
       $enemy_lawyer=Enemy_Lawyers::get();
       
       return view('enemy_lawyer.enemy_lawyer',compact('enemy_lawyer'));
    }

    public function store(Request $request)

    {
        $request->validate([
            
            'enemy_Lawyer_name' =>'required|max:255',

            'enemy_Lawyer_phone' =>'required|max:255',
        
        ]);
        
        $case_id =Cases::latest()->first()->id;

        $enemy_lawyer = Enemy_Lawyers::create([

            'enemy_Lawyer_name' => $request->enemy_Lawyer_name,

            'enemy_Lawyer_phone' => $request->enemy_Lawyer_phone,

            'case_id' => $case_id,

        ]);
        $enemy_lawyer->save();

         return redirect()->route('enemy_lawyer.index');


    }
}
