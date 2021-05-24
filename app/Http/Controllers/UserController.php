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
    
    public function showProfile($id){
  
      if (!Auth::check()) return redirect('/login');

      $user = User::find($id);
      $this->authorize('show', $user);
      
      $questions = $user->questions()->simplePaginate(3);
      $answers = $user->answers()->simplePaginate(3);

      return view('/pages.profile', ['user' => $user, 'questions' => $questions, 'answers' => $answers]);
    }

    public function paginateQuestions(Request $request, $id){
      
      $user = User::find($id);
      $questions = $user->questions();
      
      if($request->input('profile-search')) {
        $stripSearch = htmlentities(trim(str_replace(['\'', '"'], "",$request->input('profile-search'))));

        if($stripSearch != ''){
          $search = str_replace(' ',' | ', $stripSearch);
          $questions = $questions->whereRaw("search @@ to_tsquery('simple',?)", [$search])
          ->orderByRaw("ts_rank(search,to_tsquery('simple',?)) DESC", [$search]);
        }
      }
    
      $response = view('partials.profile.question', ['questions' => $questions->simplePaginate(3)])->render();
      return response()->json(array('success' => true, 'html' => $response));
    }

    public function paginateAnswers(Request $request, $id){
      $user = User::find($id);
      $answers = $user->answers();

      if($request->input('profile-search')) {
        $stripSearch = htmlentities(trim(str_replace(['\'', '"'], "",$request->input('profile-search'))));
        
        if($stripSearch != ''){
          $search = str_replace(' ',' | ', $stripSearch);
          $answers = $answers->whereRaw("search @@ to_tsquery('simple',?)", [$search])
            ->orderByRaw("ts_rank(search,to_tsquery('simple',?)) DESC", [$search]);
        }
      }

      $response = view('partials.profile.answer', ['answers' => $answers->simplePaginate(3)])->render();
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