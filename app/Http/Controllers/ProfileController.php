<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function store(StoreProfileRequest $request)
    {
        $new_profile = Profile::create($request->validated());
        return response()->json($new_profile, 200);
    }

    public function show_user_from_profileId($id)
    {
        $profile = Profile::find($id);
        if (!$profile)
            return response()->json(["messege" => "there is no profile with this id"], 404);

        return response()->json([ $profile->user], 200);
    }

        public function show_profile_from_userId($id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(["messege" => "there is no user with this id"], 404);

        return response()->json([$user->profile], 200);
    }

    public function update_profile_with_userId(UpdateProfileRequest $request,$id)
    {
        $user=User::find($id);
        if (!$user)
            return response()->json(["messege" => "there is no user with this id"], 404);

        $profile=$user->profile;
        $profile->update($request->validated());
        return response()->json($profile, 200);
    }
}
