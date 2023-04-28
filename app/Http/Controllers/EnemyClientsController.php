<?php

namespace App\Http\Controllers;

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
        'name' =>'required|string|max:255',
        'phone_number' =>'required',
        'case_id' =>'required',
    ]);

    $enemy_client=new Enemy_Clients();

    $enemy_client->name=$request->name;

    $enemy_client->phone_number=$request->phone_number;

    $enemy_client->case_id=$request->case_id;

    $enemy_client->save();

    return redirect()->route('enemy_clients.index');
 }
 
}
