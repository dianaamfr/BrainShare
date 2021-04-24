<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class QuestionPolicy
{
    use HandlesAuthorization;
    
    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function delete(User $user, Question $question)
    {
      // Only a question owner can delete it or the Administrator
      return $user->id == $question->user_id;
    }
}
