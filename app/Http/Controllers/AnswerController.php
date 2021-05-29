<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Answer;
use App\Models\User;
use App\Models\Question;


class AnswerController extends Controller{


    public function appendInfiniteScroll(Request $request, $id){

        // Validation
        $validated = $request->validate([
            'page' => 'integer'
        ]);

        $question =  Question::find(intval($id));
        $response = view('partials.common.answer-list', ['answer' => $question->answers()->simplePaginate(2)])->render();
        return response()->json(array('success' => true, 'html' => $response));
    }

    
    public function newAnswer(Request $request, $id){
        
        // Authorization
        $this->authorize('create', Answer::class);
        
        // Validation
        $validated = $request->validate([
            'text' => 'required',
            'page' => 'integer',
        ]);


        // Add the Answer
        $answer = new Answer;
        $answer->question_id = $id;
        $answer->answer_owner_id = Auth::user()->id;
        $answer->content = $request->text;
        $answer->save();

        
        // Return the changed view
        $question =  Question::find(intval($id));
        $response = view('partials.common.answer-list', ['answer' => $question->answers()->simplePaginate(2)])->render();
        return response()->json(array('success' => true, 'number_answers' => $question->number_answer,'html' => $response));

        
    }

    public function deleteAnswer($id){

        // Find Answer
        $answer = Answer::find(intval($id));

        // Authorization
        $this->authorize('delete', $answer);

        
        $answer_id = $answer->question_id;
        
        // Delete Answer
        $answer->delete();

        // Return the changed view
        $question = Question::find(intval($answer_id));
        $response = view('partials.common.answer-list', ['answer' => $question->answers])->render();
        return response()->json(array('success' => true, 'number_answers' => $question->number_answer,'html' => $response));

    }


    public function editAnswer(Request $request, $id){

        // Validation
        $validated = $request->validate([
            'text' => 'required'
        ]);
        
        // Find Comment
        $answer = Answer::find(intval($id));
        
        // Authorization
        $this->authorize('edit', $answer);
        
        // Edit Answer
        $answer->content = $request->text;
        $answer->save();

        // Return view of comments to refresh view
        $question =  Question::find(intval($answer->question_id));
        $response = view('partials.common.answer-list', ['answer' => $question->answers])->render();
        return response()->json(array(success => true, 'number_answers' => $question->number_answer,'html' => $response));

    }


}
