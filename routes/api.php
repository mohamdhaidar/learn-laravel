<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tasks',TaskController::class);

Route::post("profile/store",[ProfileController::class,'store']);

Route::post("user/store",[UserController::class,'store']);

Route::get("profile/show_profile/{id}",[ProfileController::class,'show_profile']);

Route::get("user/{id}/profile",[ProfileController::class,'show_profile_from_userId']);

Route::get("profile/{id}/user",[UserController::class,'show_user_from_profileId']);

Route::post("profile/update/{id}",[ProfileController::class,'update_profile_with_userId']);

Route::delete("Task/delete_low",[TaskController::class,'deleteLow']);
