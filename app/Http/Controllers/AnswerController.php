<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Answer;

class AnswerController extends Controller
{
    public function addAnswer(Request $request){

        // Verify if the opration is allowed
        $this->authorize('create', Answer::class);

        // Validate the parameters of the request (TODO: Check if this is ok)
        $validated = $request->validate([
            'question_id' => 'integer',
            'content' => 'required'
        ]);


        // Add the answer to the database

        /*
        $answer = new Answer;

        $answer->question_id = $request->question_id;
        $answer->answer_owner_id = Auth::user()->id;
        $answer->content = $request->content;
        */

        DB::table('answers')->insert([
            'question_id' => $request->question_id, 'answer_owner_id' =>Auth::user()->id, 'content' => $request->content,
        ]);
        /*
        $response = view('partials.answer-card', ['questions' => $questions->simplePaginate(10)])->render();
        return response()->json(array('success' => true, 'html' => $response));
        */


    }


    public function editAnswer(){

    }

    public function deleteAnswer(){

    }

  }
