<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Show the most recent questions
     *
     * @return Response
     */
    public function getMostRecentQuestions() {
      $questions = Question::orderBy('id', 'desc')->paginate(10);
      $courses = Course::all();
      return view('pages.search', ['courses' => $courses, 'questions' => $questions]);
    }

    /**
     * Show the most voted questions
     */
    public function getMostVotedQuestions(Request $request) {
      $questions = Question::orderBy('score', 'desc')->paginate(10);
      $courses = Course::all();
      return view('pages.search', ['courses' => $courses, 'questions' => $questions]);
    }
    
    /**
     * Show questions that match the advanced search
     */
    public function advancedSearch(Request $request){

      $search = str_replace(' ',' | ', $request->input('searchInput'));
      //$courses = $request->$courses;
      //$tags = $request->$tags;

      $questions = Question::whereRaw("search||Coalesce(answers_search,'') @@ to_tsquery('simple',?)", [$search])->get();

      return json_encode($questions);
    }

}
