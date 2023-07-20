<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;
use App\Models\{Task, TaskStep, Status, TaskAssign};

trait TaskAssignTrait
{
    public function getMyTaskCountList($user_id = false)
    {
        // Fetch all the data according to model
        return TaskAssign::join('statuses as s', 's.id', '=', 'task_assigns.status_id')
                ->join('task_steps as ts', 'ts.id', '=', 'task_assigns.step_id')
                ->select( DB::raw('count(task_assigns.id) as total_task, task_assigns.step_id, task_assigns.status_id, task_assigns.status_alias'), 's.status_name', 'ts.step_name')
                ->when($user_id, function($query, $user_id){
                        return $query->where('task_assigns.user_id', $user_id);
                })
                ->groupBy('task_assigns.step_id','task_assigns.status_id', 's.status_name', 'ts.step_name', 'task_assigns.status_alias')
                //->groupBy('task_assigns.step_id','task_assigns.status_id', 's.status_name', 'ts.step_name', 'task_assigns.status_alias')
                ->get();
    }

    public function getMyTaskList($user_id = false)
    {
        // Fetch all the data according to model
        return TaskAssign::join('tasks as t', 't.id', '=', 'task_assigns.task_id')
                ->join('statuses as s', 's.id', '=', 'task_assigns.status_id')
                ->join('task_steps as ts', 'ts.id', '=', 'task_assigns.step_id')
                        ->select('task_assigns.*', 't.task_name', 's.status_name', 'ts.step_name')
                        ->when($user_id, function($query, $user_id){
                            return $query->where('task_assigns.user_id', $user_id);
                        })->get();
    }


}