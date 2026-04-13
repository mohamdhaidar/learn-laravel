<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogInRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Profile;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        return response()->json([$profile->user], 200);
    }

    public function show_user_from_taskId($id)
    {
        $task = Task::find($id);

        if (!$task)
            return response()->json(["message" => "there is no task with this id"], 404);

        $user = $task->user()->get();

        return response()->json([$user], 200);

    }

    public function register(RegisterRequest $request)
    {
        $request->validated();
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );
        return response()->json(["message" => "user registered successfully", $user], 201);
    }

    public function login(LogInRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "invalid email or password"], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }

}
