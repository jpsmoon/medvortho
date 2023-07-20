<?php
namespace App\Traits;
use App\Models\{Task, TaskStep, UserTask};

trait TaskTrait
{
    public function getUserTaskList($user_id)
    {
        // Fetch all the data according to model
        return UserTask::join('tasks as t', 't.id', '=', 'user_tasks.task_id')
                        ->select('user_tasks.*', 't.task_name')
                        ->where('user_tasks.user_id', $user_id)
                        ->where('user_tasks.is_active', '1')->get();
    }
    public function getUserActiveTasks($user_id)
    {
        return UserTask::join('tasks as t', 't.id', '=', 'user_tasks.task_id')
                        ->select('user_tasks.task_id', 't.task_name', 't.slug')
                        ->where('user_tasks.user_id', $user_id)
                        ->where('user_tasks.is_active', '1')->get();
    }
    public function storeTask($request, $id = false) {
        if(!$id){ //Add here
            $tasks = new Task();
            $tasks->task_name = $request->task_name;
            $tasks->description = $request->description;
            $tasks->save();
            return $tasks;
        }else{ //Update here

            $updateArr = array(
                'task_name' => $request->task_name,
                'description' => $request->description
            );        
            return Task::where("id", $id)->update($updateArr);
        }
    }

    public function storeTaskStep($request, $id = false) {
        if(!$id){ //Add here
            $taskstep = new TaskStep();
            $taskstep->step_name = $request->step_name;
            $taskstep->save();
            return $taskstep;
        }else{ //Update here

            $updateArr = array(
                'step_name' => $request->step_name,
            );        
            return TaskStep::where("id", $id)->update($updateArr);
        }
    }

}