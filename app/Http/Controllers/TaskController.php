<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaksRequest;
use App\Http\Requests\UpdateTaksRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(StoreTaksRequest $request)
    {
        $new_task = Task::create($request->validated());
        return response()->json($new_task, 200);
    }

    public function index()
    {
        $tasks = Task::all();
        return  response()->json(["message" => "All Tasks", "data" => $tasks], 200);
    }

    public function update(UpdateTaksRequest $request, $id)
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
            return response()->json(["messege" => "didnt find id $id"], 404);

        return response()->json(["Task" => $task], 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task)
            return response()->json(["messege" => "didnt find id $id"], 404);

        $task->delete();
        return response()->json(["messege" => "the id $id is deleted"], 200);
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
}
