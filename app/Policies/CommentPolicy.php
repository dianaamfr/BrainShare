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
        // Only a comment owner can edit it or the Administrator.
        return $user->id === $comment->comment_owner_id;
    }

    public function delete(User $user, Comment $comment){
        // Only a comment owner can delete it or the Administrator
        return $user->id === $comment->comment_owner_id || $user->isAdmin() || $user->isModerator();
    }

    public function report(User $user, Comment $comment){
        return $comment->owner && $comment->owner->id != Auth::user()->id;
    }
}
