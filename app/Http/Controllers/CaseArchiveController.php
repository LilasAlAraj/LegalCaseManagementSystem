<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Http\Request;

class CaseArchiveController extends Controller
{
    public function index()
    {
        $cases = Cases::onlyTrashed()->get();
        return view('cases.Archive_Cases',compact('cases'));
    }

    public function update(Request $request)
    {
         $id = $request->case_id;
         $flight = Cases::withTrashed()->where('id', $id)->restore();
         session()->flash('restore_cases', $flight);
         return redirect('/cases');
    }

    public function destroy(Request $request)
    {
         $cases = Cases::withTrashed()->where('id',$request->case_id)->first();
         $cases->forceDelete();
         session()->flash('delete_cases', $cases);
         return redirect('/Archive');
    
    }
}
