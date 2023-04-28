<?php

namespace App\Http\Controllers;

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
            'name' =>'required|max:255',
            'case_id' =>'required',
            'number_phone' =>'required|max:255',
        
        ]);
        
        $request->only(['name','case_id','number_phone']);

        $enemy_lawyer = Enemy_Lawyers::create($request->only(['name','case_id','number_phone']));

        return back();
    }
}
