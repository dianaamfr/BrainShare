<?php


namespace App\Policies;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CoursePolicy
{
    public function showCourses(User $user){
        return Auth::check() && ($user->isAdmin()  || $user->isModerator());
    }

    public function deleteCourse(User $user){
        return Auth::check() && ($user->isAdmin()  || $user->isModerator());
    }

    public function addCourse(User $user){
        return Auth::check() && ($user->isAdmin()  || $user->isModerator());
    }
}
