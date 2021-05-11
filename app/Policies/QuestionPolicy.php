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

    public function delete(User $user, Question $question)
    {
      //dd($user->id);
      // Only a question owner can delete it or the Administrator
      return $user->id === $question->question_owner_id || Auth::user()->isAdmin() || Auth::user()->isModerator();
    }

    public function edit(User $user, Question $question){
        // Only a question owner can edit it or the Administrator.
        return $user->id == $question->question_owner_id;
    }
}
