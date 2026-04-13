<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('tasks', TaskController::class);
Route::get("user/{id}/tasks", [TaskController::class, 'show_task_by_userId']);
Route::delete("Task/delete_low", [TaskController::class, 'deleteLow']);
Route::post("task/{id}/cat", [TaskController::class, "addCatToTask"]);
Route::get("task/{id}/categories", [TaskController::class, "show_cat_of_task"]);

Route::get("task/{id}/user", [UserController::class, 'show_user_from_taskId']);
Route::post("user/store", [UserController::class, 'store']);
Route::get("profile/{id}/user", [UserController::class, 'show_user_from_profileId']);

Route::post("register", [UserController::class, 'register']);
Route::post("login", [UserController::class, 'login']);
Route::get("logout", [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::post("profile/store", [ProfileController::class, 'store']);
Route::get("user/{id}/profile", [ProfileController::class, 'show_profile_from_userId']);
Route::post("profile/update/{id}", [ProfileController::class, 'update_profile_with_userId']);

Route::post("category/store", [CategoryController::class, 'store']);

