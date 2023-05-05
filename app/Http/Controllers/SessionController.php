<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $session=Sessions::all();

        return view('session.index',compact( $session));
    }

    public function store(Request $request)

    {
         
        $request->validate([
            'number'=>'required',
            'date' => 'required',
            'description' => 'required',
            'delay_date'=>'required',
            'delay_reasons'=>'required',
        ],[
        'number.required'=>'please fill the session date',
        'date.required'=>'please fill the session date',
        'description.required'=>'please fill the description',
        'delay_date.required'=>'please fill the delay_date',
        'delay_reasons.required'=>'please fill the delay_reasons',

          
        ]);

        Sessions::create([
            
            'case_id' => $request->case_id,

            'number' =>$request->number,

            'date' => $request->date,

            'description' => $request->description,

            'delay_date' => $request->delay_date,

            'delay_reasons'=>$request->delay_reasons,

        ]);

        session()->flash('Add', 'تم اضافة الجلسة بنجاح ');

        return redirect('/sessions');

    }

    public function update(Request $request)
    {

       $id = $request->id;

       $this -> validate($request,[
        'date' => 'required',
        'description' => 'required',
        'delay_date'=>'required',
        'delay_reasons'=>'required',
    ],[

    'date.required'=>'please fill the session date',
    'description.required'=>'please fill the description',
    'delay_date.required'=>'please fill the delay_date',
    'delay_reasons.required'=>'please fill the delay_reasons',
      
    ]);

       $sections=Sessions::find($id);

       $sections->update([

        'date' => $request->date,

        'description' => $request->description,

        'delay_date' => $request->delay_date,

        'delay_reasons'=>$request->delay_reasons,

    ]);

    session()->flash('edit','تم نعديل الجلسة بنجاح');
    
    return redirect('/sections');

    }

    public function destroy(Request $request)
    {
    
        $id=$request->id;

        Sessions::find($id)->delete();

        session()->flash('delete','You delete the Sessions');

        return redirect('/Sessions');


    }
}
