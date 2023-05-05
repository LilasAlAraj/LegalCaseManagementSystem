<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Support\Facades\Storage;
use App\Models\Cases_details;
use Illuminate\Http\Request;

class CasesDetailsController extends Controller
  {


    public function store(Request $request)

    {
     Cases_details::create([

      'title' => $request->title,

      'id_Cases'=>$request->id_Cases,

      'facts'=>$request->facts,

      'legal_discussion'=>$request->legal_discussion

     ]);
           
  
    }
 
    public function update(Request $request)
    {

       $id = $request->id;

       $this -> validate($request,[
        'facts' => 'required',
        'legal_discussion' => 'required',
    ],[

    'facts.required'=>'please fill the facts date',
    'legal_discussion.required'=>'please fill the legal_discussion',
      
    ]);

       $cases_details=Cases_details::find($id);

       $cases_details->update([

        'facts' => $request->facts,

        'legal_discussion' => $request->legal_discussion,
    ]);

    session()->flash('edit','تم نعديل التفاصيل  بنجاح');
    return redirect('/cases');

    }

  }  


