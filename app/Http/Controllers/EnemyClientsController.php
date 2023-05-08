<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Enemy_Clients;
use Illuminate\Http\Request;

class EnemyClientsController extends Controller
{
    
 public function index()

 {
    $enemy_client=Enemy_Clients::get();

    return view('enemy_clients.index',compact('enemy_client'));
 }

 public function store(Request $request)
 {
    $request->validate([

        'enemy_Client_name' =>'required|string|max:255',
        
        'enemy_Client_phone' =>'required',
    ]);

    $case_id =Cases::latest()->first()->id;

    $enemy_client=new Enemy_Clients();

    $enemy_client->case_id=$request->case_id;

    $enemy_client->enemy_Client_name=$request->enemy_Client_name;

    $enemy_client->enemy_Client_phone=$request->enemy_Client_phone;

    $enemy_client->save();

    return redirect()->route('enemy_clients.index');
 }
 
}
