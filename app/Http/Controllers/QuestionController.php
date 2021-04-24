<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;
use App\Models\Course;
use App\Models\Tag;

class QuestionController extends Controller
{

    public function showQuestionForm(){
      if (!Auth::check()) return redirect('/login');
      
      $courses = Course::all();
      $tags = Tag::all();
      return view('pages.add-question', ['courses' => $courses, 'tags' => $tags]);
    }

    /**
     * Creates a new question.
     *
     * @return Question The question created.
     */
    public function create(Request $request)
    {
      $question = new Question();
      
      $this->authorize('create', Question::class);

      $validated = $request->validate([
        'title' => 'required',
        'content' => 'required',
      ]);

      // Add Question
      $question->question_owner_id = Auth::user()->id;
      $question->title = $request->title;
      $question->content = $request->content;
      $question->save();

      // Add Course
      $question->courses()->attach($request->course);
      
      // Add Tag

      // Go to the created question
      return view('pages.home');
    }
}
