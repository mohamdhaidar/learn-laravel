<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request)
    {
        $new_task = Task::create($request->validated());
        return response()->json($new_task, 200);
    }

    public function index()
    {
        $tasks = Task::all();
        return  response()->json(["message" => "All Tasks", "data" => $tasks], 200);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $newTask = Task::find($id);

        if (!$newTask)
            return response()->json(["message" => "didnt find id " . $id], 404);

        $newTask->update($request->validated());

        return response()->json([$newTask], 200);
    }

    public function show($id)
    {
        $task = Task::find($id);

        if (!$task)
            return response()->json(["message" => "didnt find id $id"], 404);

        return response()->json(["Task" => $task], 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task)
            return response()->json(["message" => "didnt find id $id"], 404);

        $task->delete();
        return response()->json(["message" => "the id $id is deleted"], 200);
    }

    public function deleteLow()
    {
        $task = Task::where("priority","<=","3")->delete();
        return response()->json(["message" => "Low priority tasks deleted",$task], 200);
    }

    public function show_task_by_userId($id)
    {
        $user=User::find($id);

        if (!$user)
            return response()->json(["messege"=>"there is no user with this id "], 404);

        $tasks=$user->tasks()->get();

        return response()->json([$user,$tasks], 200);
    } 

    public function addCatToTask($taskId,Request $re)
    {
        $task=Task::find($taskId);

        if (!$task)
            return response()->json(["message"=>"there is no task with this id "], 404);

        $real=$task->categories()->attach($re->category_id);
        return response()->json(["message"=>"Category added to task"], 200);
    }

    public function show_cat_of_task($taskId)
    {
        $task=Task::find($taskId);
        if (!$task)
            return response()->json(["message"=>"there is no task"], 200);

        return response()->json(["Task" => $task, "categories" => $task->categories()->get()], 200);
    }
}
