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
      // TODO: decide who can view deleted questions
      return $question->deleted === false || (Auth::check() && ($user->isAdmin() ||
        $user->isModerator() || $user->id === $question->question_owner_id));
    }

    public function delete(User $user, Question $question)
    {
      //dd($user->id);
      // Only a question owner can delete it or the Administrator
      return $user->id === $question->question_owner_id || $user->isAdmin() || $user->isModerator();
    }

    public function edit(User $user, Question $question){

        // Only a question owner or Administrators/Moderators can edit it 
        // TODO: decide if this is the desired policy
        return Auth::check() && $question->deleted === false && ($user->id == $question->question_owner_id || $user->isModerator() || $user->isAdmin());
    }
}
