<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy{
    use HandlesAuthorization;

    public function create(){
      // Any user can create a new answer
      return Auth::check();
    }


    public function edit(User $user, Comment $comment){
        // Only a question owner can edit it or the Administrator.
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, Comment $comment){
      // Only a question owner can delete it or the Administrator
      return $user->id === $comment->answer_owner_id || Auth::user()->isAdmin() || Auth::user()->isModerator();
    }
}
