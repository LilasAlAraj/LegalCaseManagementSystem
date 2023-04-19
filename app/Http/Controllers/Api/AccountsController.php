<?php

namespace App\Http\Controllers\Api;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
   public function index()
   {
    $account=Accounts::get();

    $msg=["OK"];
    
    return response($account,200,$msg); 
   }
   

}
