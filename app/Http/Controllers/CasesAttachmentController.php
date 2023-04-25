<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Cases_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CasesAttachmentController extends Controller
{
  
    
    public  function store(Request $request)
    {
        $this->validate($request,[
            
            'file_name' => 'mimes:pdf,jpeg,png,jpg',
    
            ], [
                'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
            ]);
            
            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();
            $attachments =  new Cases_attachments();
            $attachments->file_name = $file_name;
            $attachments->cases_number = $request->cases_number;
            $attachments->cases_id = $request->cases_id;
            $attachments->Created_by = Auth::user()->name;
            $attachments->save();

            

            // move pic
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/'. $request->cases_number), $imageName);
            
            session()->flash('Add', 'تم اضافة المرفق بنجاح');
            return back();

    }
}
