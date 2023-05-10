<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksTypeContorller extends Controller
{
    public function index()
    {
        $task_type=Task_type::all();

        return view('task_type.index',compact( $task_type));
    }
    public function store(Request $request)
    {
        $request->validate([
            'task_type_name' => 'required',
            
        ],[

        'task_type_name.required'=>'please insert the task type name',
          
        ]);
        $task_type =new Task_type();
        $task_type->task_type_name =$request->task_name;
        $task_type->save();
        return redirect()->route('task_type.index');
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $task_type =Task_type::findOrfail($id);
        $request->validate([
            'task_type_name' => 'required',
            
        ],[

        'task_type_name.required'=>'please insert the task type name',
          
        ]);
        $task_type->task_type_name =$request->task_type_name;
        $task_type->save();
        return redirect()->route('task_type.index');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        Task_type::findOrfail($id)->delete();
        return redirect()->route('task_type.index');
    }
}
