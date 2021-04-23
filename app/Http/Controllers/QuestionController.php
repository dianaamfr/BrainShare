<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;
use App\Models\Course;

class QuestionController extends Controller
{
    /**
     * Shows the search page
     *
     * @return Response
     */
    public function getMostVoted()
    {
      $questions = Question::paginate(10);
      //$questions = Question::orderByRaw('score DESC')->paginate(10);
      return view('pages.search', ['questions' => $questions]);
    }

    public function showQuestionForm(){
      if (!Auth::check()) return redirect('/login');
      $courses = Course::all();
      return view('pages.add-question', ['courses' => $courses]);
    }

    /**
     * Creates a new question.
     *
     * @return Question The question created.
     */
    public function create(Request $request)
    {
      $question = new Question();
      
      //$this->authorize('create', Question::class);

      $question->question_owner_id = Auth::user()->id;
      $question->title = $request->input('title');
      $question->content = 'dncnsd';

      $question->save();
      $question->courses()->attach($request->course);

      return view('pages.home');
    }
}
