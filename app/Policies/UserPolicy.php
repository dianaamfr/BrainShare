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

    public function showManageUsers(){
      return Auth::user()->isAdmin() || Auth::user()->isModerator();
    }

    public function delete(User $user, User $deleted){

      $deletedIsAdminOrModerator = $deleted->isAdmin() || $deleted->isModerator();
      $userIsAdminOrModerator = $user->isAdmin() || $user->isModerator();

      // Administrators can delete other Administrators or Moderators
      if($deletedIsAdminOrModerator && $user->isAdmin()){

        // Avoid deleting all Administrators
        if($deleted->id == $user->id) {
          $admins = User::where('user_role','Admnistrator')->count();
          return $admins > 1;
        }
        return true;
      }
      
      // Admnistrators and Moderators can delete Registered Users
      if(!$deletedIsAdminOrModerator && $userIsAdminOrModerator)
        return true;

      // The own user may delete his account
      return $user->id == $deleted->id;
    }

    public function updateState(User $user, User $updated){

      $updatedIsAdminOrModerator = $updated->isAdmin() || $updated->isModerator();
      $userIsAdminOrModerator = $user->isAdmin() || $user->isModerator();

      // Administrators can change the role of other Administrators or Moderators
      if($updatedIsAdminOrModerator && $user->isAdmin()){

        // Avoid deleting all Administrators
        if($updated->id == $user->id) {
          $admins = User::where('user_role','Admnistrator')->count();
          return $admins > 1;
        }
        return true;
      }

      // Admnistrators and Moderators can change the role of Registered Users
      return(!$updatedIsAdminOrModerator && $userIsAdminOrModerator);
    }
}