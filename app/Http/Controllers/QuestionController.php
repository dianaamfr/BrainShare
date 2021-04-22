<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Shows the search page
     *
     * @return Response
     */
    public function getMostVoted()
    {
      $questions = Question::orderByRaw('score DESC')->paginate(10);
      return view('pages.search', ['questions' => $questions]);
    }
}
