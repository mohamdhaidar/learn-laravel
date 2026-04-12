<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Profile;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $new_user = User::create($request->validated());
        return response()->json($new_user, 200);
    }

    public function show_user_from_profileId($id)
    {
        $profile = Profile::find($id);
        if (!$profile)
            return response()->json(["message" => "there is no profile with this id"], 404);

        return response()->json([ $profile->user], 200);
    }

    public function show_user_from_taskId($id){
        $task=Task::find($id);

        if (!$task)
            return response()->json(["message" => "there is no task with this id"], 404);

        $user=$task->user()->get();

        return response()->json([$user], 200);

    }


}
