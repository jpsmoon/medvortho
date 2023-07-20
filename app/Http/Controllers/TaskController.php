<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function index()
    {
       $tasks = $this->getActiveData(Task::class, 'task_name');
        
        $i =  (request()->input('page', 1) - 1) * 5;
        return view('masters.tasks.index', compact('tasks', 'i'));
    }

    public function store(Request $request)
    {
        request()->validate(['task_name' => 'required']);

        $tasks = $this->storeTask($request);
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data inserted successfully',
            'records'  =>$tasks
          ]
        );
    }

    public function show(Task $task)
    {
        //
    }
    
    public function update(Request $request, Task $task)
    {
        request()->validate(['task_name' => 'required']);

        $this->storeTask($request, $task->id);
        Session::flash('success', 'Data updated successfully!');
        //session()->now('message', 'Success! message.');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data updated successfully',
            'records'  =>$task
          ]
        );
    }

    public function destroy(Task $task)
    {
        $this->deleteRow(Task::class, $task->id);
        Session::flash('success', 'Data blocked successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data blocked successfully'
          ]
        );
    }

    public function restore(Request $request)
    {
        $this->restoreRow(Task::class, $request->id);
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
}
