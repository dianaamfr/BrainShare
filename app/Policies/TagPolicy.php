<?php


namespace App\Policies;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TagPolicy
{
    public function showTags(User $user){
        return Auth::check() && ($user->isAdmin()  || $user->isModerator());
    }

    public function deleteTag(User $user){
        return Auth::check() && ($user->isAdmin()  || $user->isModerator());
    }

    public function addTag(User $user){
        return Auth::check() && ($user->isAdmin()  || $user->isModerator());
    }
}
