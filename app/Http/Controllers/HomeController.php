<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;

class HomeController extends Controller
{
    /**
     * Shows the home page
     *
     * @return Response
     */
    public function show()
    {
      $questions = Question::with(['owner','courses', 'tags'])->where('deleted', '=', false)->orderBy('score', 'desc');
      return view('pages.home', ['questions' => $questions->limit(5)->get()]);
    }
  }
