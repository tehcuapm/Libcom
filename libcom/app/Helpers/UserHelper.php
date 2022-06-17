<?php

namespace App\Helpers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    const DEFAULT_PATH = "storage/assets/default_user.png";

    public static function handleAvatar(User $currentUser)
    {
        $image = $currentUser->current_avatar;
        return $image != null ? $currentUser->avatar->path_file : UserHelper::DEFAULT_PATH;
    }

    public static function checkProfile(User $userProfile)
    {
        return Auth::check() && $userProfile->id == Auth::user()->id;
    }

    public static function checkVerified(User $user)
    {
        return $user->hasVerifiedEmail();
    }

    public static function initUserAvatars(User $user)
    {
        $avatars = Avatar::all();
        $user->avatars()->saveMany($avatars->random(2));
        //$user->current_avatar = $rand_av->id;
        $user->save();
    }
}
