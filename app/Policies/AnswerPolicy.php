<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Answer;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AnswerPolicy{
    use HandlesAuthorization;

    public function create(){
      // Any user can create a new answer, sa long as he is logged in
      return Auth::check();
    }

    public function edit(User $user, Answer $answer){
      // Only a question owner can edit the question;
      return $user->id === $answer->answer_owner_id;
    }

    public function delete(User $user, Answer $answer){
      // Only a question owner or the Administrator can delete it
      return $user->id === $answer->answer_owner_id || Auth::user()->isAdmin() || Auth::user()->isModerator();
    }

    public function valid(User $user, Answer $answer){
      // Only a question owner can mark answers as valid.
      return $user->id === $answer->question->question_owner_id;
  }
}
