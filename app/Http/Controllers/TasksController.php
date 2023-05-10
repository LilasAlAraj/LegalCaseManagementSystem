<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    
    public function index()
    {
        $tasks=Task::get();
        return view('task.task',compact('tasks'));
    }

    public function create()
    {
        $tasks=Task::all();
        return view('task.task_add',compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'type_id'=>'required',
        'task_name'=>'required',
        'description'=>'description',
        'start_date'=>'start_date',
        'end_date'=>'end_date',
        'status'=>'status',
        'status_value'=>'status_value',
        'user_name'=>'user_name',
        'case_number'=>'case_number'
        ]);

        $task::create([
            'type_id'=> $request->type_id,
            'task_name'=>$request->task_name,
            'description'=>$request->description,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'status'=>$request->status,
            'status_value'=>$request->status_value,
            'user_first_name'=>$request->user_first_name,
            'user_last_name'=>$request->user_last_name,
            'case_number'=>$request->case_number
        ]);

        $task_id= Task::latest()->first()->id;

        $List_Users =$request->List_Users;
        $validated = $request->validated();
        foreach($List_Users as $List_User){
            $users =new User();
            $users->first_name =$List_User['user_first_name'];
            $users->last_name= $List_User['user_last_name'];
            $users->task_id =$List_User['task_id'];
            $users->save();
        }

        $List_Cases =$request->List_Cases;
        $validated = $request->validated();
        foreach($List_Cases as $List_Case){
            $cases =new Cases();
            $cases->case_number =$List_Case['case_number'];
            $cases->task_id =$List_Case['task_id'];
            $cases->save();
        }

        
        return redirect()->route('task.index');
    }

    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //$task= Task::findOrFail($id);
        $task = Task::where('id', $id)->first();
        return view('task.edit', compact('task'));
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task::update([
            'type_id'=> $request->type_id,
            'task_name'=>$request->task_name,
            'description'=>$request->description,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'status'=>$request->status,
            'status_value'=>$request->status_value,
            'user_first_name'=>$request->user_first_name,
            'user_last_name'=>$request->user_last_name,
            'case_number'=>$request->case_number
        ]);

        return redirect()->route('task.index');
    }

    public function destroy(string $id)
    {
        Task::findOrfail($id)->delete();
        return redirect()->route('task.index');
    }

    //active(0) -done (1)- pending(2)
    public function update_task_status (Request $request ,$id){

        //$getStatus =Task::select('status_value')where('id',$id)->first();
        $task_status=Task::findOrfail($id);

        if($request->status ==='active'){
            $task_status->update([
                'status_value'=>0,
                'status' =>$request->status
            ]);
        }
        elseif($request->status ==='pending'){
            $task_status->update([
                'status_value'=>2,
                'status' =>$request->status
            ]);
        }
        else{
            $task_status->update([
                'status_value'=>1,
                'status' =>$request->status
            ]);
        }

        return redirect('/task');
    }
}
