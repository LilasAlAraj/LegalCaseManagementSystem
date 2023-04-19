<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
   public function index()

   {
    $account=Accounts::get();
    
    return view('account.account',compact('account'));

   }

   public function create()

   {
    return view('account.create');
   }

   public function store(Request $request)

   {
    $request->validate([
        'First_Name' => 'required',
        'Middle_Name' => 'required',
        'Last_Name' => 'required',
        'Phone_Number' => 'required',
        'Password' => 'required'
    ]);
    Accounts::create
    
    ([
        'First_Name' => $request->First_Name,
        'Middle_Name' => $request->Middle_Name,
        'Last_Name' => $request->Last_Name,
        'Location' => $request->Location,
        'Phone_Number' => $request->Phone_Number,
        'Email' => $request->Email,
        'Password' => bcrypt($request->input('Password')),

    ]);
    session()->flash('message', 'This account is created');
       
        return redirect()->route('login');

   }

   public function edit($id)

   {
       $accounts = Accounts::where('id', $id)->first();
       return view('accounts.edit_accounts');
   }

   public function update(Request $request)

   {
    $accounts = Accounts::findOrFail($request->id);
    $accounts->update

    ([
        'First_Name' => $request->First_Name,
        'Middle_Name' => $request->Middle_Name,
        'Last_Name' => $request->Last_Name,
        'Location' => $request->Location,
        'Phone_Number' => $request->Phone_Number,
        'Email' => $request->Email,
        'Password' => $request->Password,
    ]);
    return back();

   }

   public function destroy($id)

  {


    try {

        Accounts::destroy($id);
        return redirect()->back()->with('delete', 'Data has been deleted successfully');

    } catch (\Exception $e) {

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

  }

   
}
