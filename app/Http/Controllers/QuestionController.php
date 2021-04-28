<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;
use App\Models\Course;
use App\Models\Tag;
use App\Models\User;

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
    
    public function showEditQuestionForm($id){   
      $question = Question::find($id); 
      $question_owner_id = $question['question_owner_id']; 
      if (!Auth::check()) return redirect('/login');
      else if (!(Auth::user()->id == $question_owner_id || Auth::user()->isModerator() || Auth::user()->isAdmin())) return redirect('/error');    
      $courses = Course::all(); 
      $tags = Tag::all();  
      return view('pages.edit-question', ['question'=> $question, 'courses' => $courses, 'tags' => $tags]); 
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

        return $question;
      }); 

      // Go to the created question
      if ($result !== null) { 
        return redirect()->route('showQuestion', ['id' => $result->id]);
      }
      else { 
        return redirect()->route('question');
      }
    }

    // Não sei se é preciso mandar o userId, ou se é poss+ivel obter diretamente o User
    public function deleteQuestion($questionId){

        $question = Question::find($questionId);
        $user = User::find($question->question_owner_id); 
        
        // If you are not logged in, redirect to the login page 
        if(!Auth::check()) return redirect('login');

        // If you hav eno permissions to delete de questions, redirect to the same page 
        if (!(Auth::user()->id == $ownerId || Auth::user()->isModerator() || Auth::user()->isAdmin()) || !$this->authorize($user,$question)) 
            return redirect('/question/{' . $questionId . '}');
            //return redirect()->back();
        
        // Delete the question from the table
        $question->delete();

        // Return to the search page if the question is sucessfull deleted
        return view('pages.search');
    }

}
