<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Support\Facades\Storage;
use App\Models\Cases_attachments;
use App\Models\Cases_details;
use Illuminate\Http\Request;

class CasesDetailsController extends Controller
  {

    public function edit($id)
    {

   
        $cases = Cases::where('id',$id)->first();

        $details  = Cases_details::where('id_cases',$id)->get();

        $attachments  = Cases_attachments::where('cases_id',$id)->get();

        return view('Cases.cases',compact('cases','details','attachments'));
        
    }




   public function destroy(Request $request)

   { 
    
    $cases=Cases_attachments::findOrFail($request->id_file);
    
    $cases->delete();

    Storage::disk('public_uploads')->delete($request->cases_number.'/'.$request->file_name);

    session()->flash('delete', 'تم حذف المرفق بنجاح');
    
    return back();
   }




  }  


