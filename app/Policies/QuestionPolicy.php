<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function create()
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function show(?User $user, Question $question)
    {
      return $question->deleted === false || (Auth::check() && ($user->isAdmin() ||
        $user->isModerator()));
    }

    public function delete(User $user, Question $question)
    {
      // Only a question owner can delete it or the Administrator
      return $user->id === $question->question_owner_id || $user->isAdmin() || $user->isModerator();
    }

    public function edit(User $user, Question $question){

        // Only a question owner or Administrators/Moderators can edit it 
        return Auth::check() && $question->deleted === false && ($user->id == $question->question_owner_id || $user->isModerator() || $user->isAdmin());
    }

    public function markValid(User $user, Question $question){
        return Auth::check() && Auth::id() === $question->question_owner_id;
    }
}
