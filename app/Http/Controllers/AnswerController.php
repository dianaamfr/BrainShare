<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Answer;

class AnswerController extends Controller{
    public function addAnswer(Request $request){

        // Authorization
        if(!$this->authorize('create', Answer::class)) return redirect('login');

        // Validate the parameters of the request (TODO: Check if this is ok)
        $validated = $request->validate([
            'question_id' => 'integer',
            'content' => 'required'
        ]);


        // Add the answer to the database (Id has default value, hence should be omissible)
        $answer = new Answer;
        $answer->question_id = $request->question_id;
        $answer->answer_owner_id = Auth::user()->id;
        $answer->content = $request->content;
        $answer->save();
        
        
        // Get the quuestion in order to find all the answers again
        $question Question::find($request->$question_id);
        
        $response = view('partials.answer-card', [$question->answers, 'answer')->render();
        return response()->json(array('success' => true, 'html' => $response));


    }


    public function editAnswer(Request $request){
        // Verify if the edit-answer operation is allowed

        $this->authorize('edit', $answer);

        $validated = $request->validate([
            'id' => 'required',
            'content' => 'required',
            'commentList' => 'distinct',
        ]);

        


    }

    // Tenho que mudar para uma request porque isto é feito por ajax
    public function deleteAnswer($answerID){

        $answer = Answer::find($answerID);

        // Verify if the deelte-answer operation is allowed
        $this->authorize('delete', $answer);

        // Delete the question from the table
        $answer->delete();
         // Get the quuestion in order to find all the answers again
        $question Question::find($answer->$question_id);
    
        $response = view('partials.answer-card', [$question->answers, 'answer')->render();
        return response()->json(array('success' => true, 'html' => $response));
    }

}
