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
    public function search(Request $request) {
      
      // Ajax requests
      if ($request->ajax() || $request->isXmlHttpRequest()){
        $response = $this->advancedSearch($request);
        return response()->json(array('success' => true, 'html' => $response));
      }

      $courses = Course::all();

      if($request->has('nav-search-input') && $request->input('nav-search-input') != ''){
        $search = str_replace(' ',' | ', $request->input('nav-search-input'));
        $questions =  Question::whereRaw("search||Coalesce(answers_search,'') @@ to_tsquery('simple',?)", [$search])->orderByRaw("ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple',?)) DESC", [$search]);
      }
      else {
        $questions = Question::orderBy('id', 'desc');
      }
      
      session()->flashInput($request->input());
      return view('pages.search', ['courses' => $courses, 'questions' => $questions->simplePaginate(10)]);
      
    }
    
    /**
     * Show questions that match the advanced search
     */
    public function advancedSearch(Request $request){

      $courses = json_decode($request->input('courses'));
      $tags = json_decode($request->input('tags'));
      $questions = Question::with(['owner','courses', 'tags']);

      // Filter by course
      if(count($courses) > 0){
        $questions = $questions->whereHas('courses', function ($query) use ($courses){
          $query->whereIn('id', $courses);
        });   
      } 

      // Filter by tag
      if(count($tags) > 0){
        $questions = $questions->whereHas('tags', function ($query) use ($tags){
          $query->whereIn('id', $tags);
        });   
      } 
    
      // Filter by text search
      if($request->input('search-input') != ''){
        $search = str_replace(' ',' | ', $request->input('search-input'));
        $questions = $questions->whereRaw("search||Coalesce(answers_search,'') @@ to_tsquery('simple',?)", [$search]);
      }

      // Order questions
      if($request->input('filter') == 'votes'){
        $questions = $questions->orderBy('score', 'desc');
      }
      else if($request->input('filter') == 'relevance'){
        $questions = $questions->orderByRaw("ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple',?)) DESC", [$search]);
      }
      else {
        $questions = $questions->orderBy('id', 'desc');
      } 
  
      return view('partials.search-questions', ['questions' => $questions->simplePaginate(10)])->render();
    }

}
