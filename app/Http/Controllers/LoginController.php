<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function show_login_form()
    {
        return view('login');
    }

    public function process_login(Request $request)
    {
        $request->validate([
            'Phone_Number' => 'required',
            'Password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = Accounts::where('Phone_Number',$request->Phone_Number && 'Password',$request->Password)->first();

        if (auth()->attempt($credentials)) {

            return redirect()->route('home');

        }else{
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Accounts::logout();

        return redirect()->route('login');
    }
}
