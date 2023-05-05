<?php

namespace App\Http\Controllers;

use App\Models\Desicions;

use Illuminate\Http\Request;

class DesicionController extends Controller

{
 
    public function index()

    {

      $desicion=Desicions::all();

      return view('desicions.desicion.index',compact('desicion')); 

    }

    public function store(Request $request)

    {
          
        $request->validate([
            'number' => 'required',
            'date' => 'required',
            'description'=>'required',
            'case_id'=>'required',
        ],[

        'date.required'=>'please fill the desicion date',
        'description.required'=>'please fill the description',
        'number.required'=>'please fill the number',
          
        ]);
        Desicions::create

        ([
          'number'=>$request->number,
          'date'=>$request->date,
          'description'=>$request->description,
          'case_id'=>$request->case_id
        ]);

        session()->flash('Add', 'تم اضافة القرار بنجاح ');

        return redirect('/desicions');


    }
    public function update(Request $request)
    {

       $id = $request->id;

       $this -> validate($request,[
        'date' => 'required',
        'description' => 'required',
        'number'=>'required',
    ],[

    'date.required'=>'please fill the desicion date',
    'description.required'=>'please fill the description',
    'number.required'=>'please fill the number',
    'delay_reasons.required'=>'please fill the delay_reasons',
      
    ]);

       $desicion=Desicions::find($id);

       $desicion->update([
        'date' => $request->date,
        'description' => $request->description,
        'number' => $request->number,
    ]);

    session()->flash('edit','تم نعديل القرار بنجاح');
    return redirect('/desicions');

    }

    public function destroy(Request $request)
    {
    
        $id=$request->id;

        Desicions::find($id)->delete();

        session()->flash('delete','You delete the Desicension');

        return redirect('/desicions');


    }

}
