<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function show()
    {
        return Auth::check();
    }

    public function showManageUsers()
    {
        return Auth::user()->isAdmin() || Auth::user()->isModerator();
    }

    // Only the user can edit it's profile.
    public function showEditUserProfile(User $user): bool
    {
        return Auth::user()->id == $user->id;
    }

    public function editUserProfile(User $user): bool
    {
        return Auth::user()->id == $user->id;
    }

    public function delete(User $user, User $deleted): bool
    {

        // Administrators can delete any user
        if ($user->isAdmin()) {
            return true;
        }

        // Moderators can only delete Registered Users
        $deletedIsRegisteredUser = !$deleted->isAdmin() && !$deleted->isModerator();
        if ($deletedIsRegisteredUser && $user->isModerator())
            return true;

        // The own user may delete his account
        return $user->id == $deleted->id;
    }

    public function updateState(User $user, User $updated)
    {

        // Administrators can change the role of any user
        if ($user->isAdmin()) {
            return true;
        }

        // Moderators can only change the role of Registered Users or of themselves
        $updatedIsRegisteredUser = !$updated->isAdmin() && !$updated->isModerator();

        return $updatedIsRegisteredUser && $user->isModerator();
    }
}
