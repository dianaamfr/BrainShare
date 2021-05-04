<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class UserController extends Controller
{
    // In A9 implement this in UserController
    public function showProfile($id){
  
      if (!Auth::check()) return redirect('/login');
      $user = User::find($id);
      $questions = Question::where('question_owner_id', $id)->simplePaginate(3);
      $answers = Answer::where('answer_owner_id', $id)->simplePaginate(3);

      return view('/pages.profile', ['user' => $user, 'questions' => $questions, 'answers' => $answers]);
    }

    public function paginateQuestions(Request $request, $id){
      $questions = Question::where('question_owner_id', $id)->simplePaginate(3);

      $response = view('partials.profile.question', ['questions' => $questions])->render();
      return response()->json(array('success' => true, 'html' => $response));
    }

    public function paginateAnswers(Request $request, $id){
      $answers = Answer::where('answer_owner_id', $id)->simplePaginate(3);

      $response = view('partials.profile.answer', ['answers' => $answers])->render();
      return response()->json(array('success' => true, 'html' => $response));
    }

    public function deleteUser($id){

      $user = User::find($id);

      // if you are not the user, you cannot delete your profile
      if(Auth::user()->id != $id) return redirect('/user/{'.$id.'}');

      $user->delete();
      
      return view('/home');
    }
}