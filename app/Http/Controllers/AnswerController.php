<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Answer;
use App\Models\User;
use App\Models\Question;

// TODO: decide how to update number of answers in the db when the answer is deleted
class AnswerController extends Controller{
    public function newAnswer(Request $request, $id){
        // Authorization
        $this->authorize('create', Answer::class);
        
        // Validation
        $validated = $request->validate([
            'text' => 'required'
        ]);


        // Add the Answer
        $answer = new Answer;
        $answer->question_id = $id;
        $answer->answer_owner_id = Auth::user()->id;
        $answer->content = $request->text;
        $answer->save();

        
        // Return the changed view
        $question =  Question::find(intval($id));
        $answers = $this->getAnswers($question);

        $response = view('partials.common.answer-list', ['answers' => $answers])->render();
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
        $answers = $this->getAnswers($question);
        
        $response = view('partials.common.answer-list', ['answers' => $answers])->render();
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
        $answers = $this->getAnswers($question);

        $response = view('partials.common.answer-list', ['answers' => $answers])->render();
        return response()->json(array('success' => true, 'number_answers' => $question->number_answer,'html' => $response));
    }

    private function getAnswers(Question $question){
        return Auth::check() && Auth::user()->isAdmin() || Auth::user()->isModerator() ? $question->answers : $question->answersNotDeleted;
    }

    public function markValid(Request $request) {
        $answer = Answer::find($request->answerId);

        if (!Auth::check()) return response()->json(['error' => 'Not logged in']);

        $this->authorize('valid', $answer);

        if ($answer->valid) {
            $answer->valid = false;
        } else {
            $answer->valid = true;
        }
        $answer->update();

        return response()->json(['success'=> 'Your request was completed', 'valid' => $answer->valid, 'answerId' => $request->answerId]);
    }
}
