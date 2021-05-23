<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function show(){
      return Auth::check();
    }

    public function showManageUsers(User $user){
      return Auth::check() && ($user->isAdmin() || $user->isModerator());
    }

    public function updateState(User $user, User $updated){
      if(!Auth::check()) return false;
      
      // Administrators can change the role of any user
      if ($user->isAdmin()){
        return true;
      }

      // Moderators can only change the role of Registered Users or of themselves
      $updatedIsRegisteredUser =  !$updated->isAdmin() && !$updated->isModerator();

      return $updatedIsRegisteredUser && $user->isModerator();
    }
}