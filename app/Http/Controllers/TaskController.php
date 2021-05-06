<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //Task API Controller

    function addTask(Request $request)
    {
        /*
            this function creates the task for the user
            parameters: 
                    put request:
                            1.user_id
                            2.task_description
                            3.status(default = 'pending') 
        */

        $task = new Task;
        $task->user_id = $request->user_id;
        $task->task = $request->task;
        if($request->task_status != NULL){
            $task->status = $request->task_status;
        }
        else
            $task->status = "pending";
        $status = $task->save();

        if($status)
        {
            return response()->json(["taskObject" => $task, "status" => 1, "message" => "task  created successfully"], 200);
        }
        else{
            return response()->json(["status" => 0, "message" => "Operation failed"], 301);
        }
    }

    function updateStatus(Request $request)
    {
        /*
            this function updates the status of the task
            parameters:
                    put request:
                            1.task_id
                            2.status
        */
        $task = Task::find($request->task_id);
        
        if($task)
        {
            $task->status = $request->status;
            $status = $task->save();
            if($status)
            {
                return response()->json(["taskObject" => $task, "status" => 1, "message" => "Marked task as ".$request->status], 200);
            }
            else{
                return response()->json(["status" => 0, "message" => "Operation failed"], 301);
            }
        }
        else{
            return response()->json(["message" => "Object Not Found"], 404);
        }
    }
}
