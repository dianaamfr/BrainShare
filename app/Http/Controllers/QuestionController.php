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

    public function show($id) {
      $question = Question::find($id);
      return view('pages.question', ['question' => $question]);
    }

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
      $this->authorize('create', Question::class);

      $validated = $request->validate([
        'title' => 'required',
        'content' => 'required',
        'courseList' => 'max:2',
        'courseList.*' => 'distinct',
        'tagList' => 'max:5',
        'tagList.*' => 'distinct',
      ]);
      
      $result = DB::transaction(function() use($request) {
        $question = new Question();

        // Add Question
        $question->question_owner_id = Auth::user()->id;
        $question->title = $request->title;
        $question->content = $request->content;
        $question->save();

        // Add Courses and tags
        $tags = $request->get('tagList');
        $courses = $request->get('courseList');
        
        if($tags != null) {
          foreach ($tags as $tag) {
            $question->tags()->attach($tag);
          }
        }

        if($courses != null) {
          foreach ($courses as $course) {
            $question->courses()->attach($course);
          }
        }

        return 1;
      });

      // Go to the created question
      if ($result !== null) {
        return redirect()->route('showQuestion', ['id' => $result]);
      }
      else {
        return redirect()->route('question');
      }
    }
}
