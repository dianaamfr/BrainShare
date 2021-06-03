<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Report;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReportPolicy
{
    use HandlesAuthorization;
    
    public function show(User $user) {
      return Auth::check() && ($user->isAdmin() || $user->isModerator());
    }

    public function update(User $user, Report $report){

        if(!Auth::check() || (!$user->isAdmin() && !$user->isModerator())) 
            return false;

        // Administrators/Moderators cannot discard a report when they are the owners of the reported content
        if((!is_null($report->reported) && $report->reported->id === $user->id) ||
            (!is_null($report->question) && $report->question->id === $user->id) || 
            (!is_null($report->answer) && $report->answer->id === $user->id) ||
            (!is_null($report->comment) && $report->comment->id === $user->id)) {
            return false;
        }

        // Administrators cannot discard a report made by themselves
        if($user->isAdmin()){
            return true;
        }

        // Moderators can discard any report from Registered Users
        return $user->isModerator() && (
            (!is_null($report->reported) && $report->reported->user_role === 'RegisteredUser') || 
            (!is_null($report->question) && (is_null($report->question->owner) || $report->question->owner->user_role === 'RegisteredUser')) ||
            (!is_null($report->answer) && (is_null($report->answer->owner) || $report->answer->owner->user_role === 'RegisteredUser')) ||
            (!is_null($report->comment) && (is_null($report->comment->owner) || $report->comment->owner->user_role === 'RegisteredUser')));

    }
}