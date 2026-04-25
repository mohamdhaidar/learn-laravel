<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function allTasks()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    public function store(StoreTaskRequest $request)
    {
        $user_id = Auth::user()->id;

        if (!$user_id)
            return response()->json(["message" => "i cant access to the id"], 403);

        $validated = $request->validated();
        $validated['user_id'] = $user_id;

        $new_task = Task::create($validated);

        return response()->json($new_task, 200);
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user)
            return response()->json(["message" => "i cant access to the user"], 403);

        $tasks = $user->tasks()->get();
        return response()->json(["message" => "All Tasks for user id : $user->id", "data" => $tasks], 200);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $user_id = Auth::user()->id;

        if (!$user_id)
            return response()->json(["message" => "i cant access to the id"], 403);

        $updateTask = Task::find($id);

        if (!$updateTask)
            return response()->json(["message" => "didnt find id " . $id], 404);

        if ($user_id != $updateTask->user_id)
            return response()->json(["message" => "you are not authorized to update this task"], 403);

        $updateTask->update($request->validated());

        return response()->json($updateTask, 200);
    }

    public function show($id)
    {
        $task = Task::find($id);

        $user = Auth::user();

        if (!$task)
            return response()->json(["message" => "didnt find id $id"], 404);

        if ($task->user()->id != $user->id)
            return response()->json(["message" => "you are not authorized to see this task"], 403);

        return response()->json(["Task" => $task], 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        $user = Auth::user();

        if (!$task)
            return response()->json(["message" => "didnt find id $id"], 404);

        if ($task->user()->id != $user->id)
            return response()->json(["message" => "you are not authorized to delete this task"], 403);

        $task->delete();
        return response()->json(["message" => "the id $id is deleted"], 200);
    }

    public function deleteLow()
    {
        $task = Task::where("priority", "<=", "3")->delete();
        return response()->json(["message" => "Low priority tasks deleted", $task], 200);
    }

    public function addCatToTask($taskId, Request $re)
    {
        $task = Task::find($taskId);

        $user = Auth::user();

        if (!$task)
            return response()->json(["message" => "there is no task with this id "], 404);

        if ($task->user()->id != $user->id)
            return response()->json(["message" => "you are not authorized to this task"], 403);

        return response()->json(["message" => "Category added to task"], 200);
    }

    public function show_cat_of_task($taskId)
    {
        $task = Task::find($taskId);
        if (!$task)
            return response()->json(["message" => "there is no task"], 200);

        return response()->json(["Task" => $task, "categories" => $task->categories()->get()], 200);
    }
}
