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
            'counter' => 'integer'
        ]);

        $question =  Question::find(intval($id));
        $query = $question->answers()->offset($request->counter)->limit(5)->get();

        $response = view('partials.common.answer-list', ['answer' => $query])->render();
        return response()->json(array('success' => true,'number_answers' => $question->number_answer, 'html' => $response));
    }

    
    public function newAnswer(Request $request, $id){
        
        // Authorization
        $this->authorize('create', Answer::class);
        

        
        // Validation
        $validated = $request->validate([
            'text' => 'required',
            'counter' => 'integer'
        ]);
        
        $number_answer = Question::find(intval($id))->number_answer;
        // Add the Answer
        $answer = new Answer;
        $answer->question_id = $id;
        $answer->answer_owner_id = Auth::user()->id;
        $answer->content = $request->text;
        $answer->save();

        

        if( ($request->counter + 1) < $number_answer){
            return response()->json(array('success' => true, 'number_answers' => $number_answer));
        }
        // Return the changed view
        $response = view('partials.common.answer-list', ['answer' => array($answer)])->render();
        return response()->json(array('success' => true, 'number_answers' => $number_answer,'html' => $response));

        
    }

    public function deleteAnswer($id){

        // Find Answer
        $answer = Answer::find(intval($id));

        // Authorization
        $this->authorize('delete', $answer);

        
        $question_id = $answer->question_id;
        
        // Delete Answer
        $answer->delete();

        $question =  Question::find(intval($question_id));
        // Return the changed view
        return response()->json(array('success' => true, 'number_answers' => $question->number_answer, 'answer_id' => $id));

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
        return response()->json(array('success' => true, 'number_answers' => $question->number_answer,'content' => $request->text, 'answer_id' => $id));

    }


}
