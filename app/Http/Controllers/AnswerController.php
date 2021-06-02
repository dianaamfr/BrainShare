<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $query = $this->getAnswers($question)->offset($request->counter)->limit(5)->get();

        $response = view('partials.common.answer-list', ['answers' => $query])->render();
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


        // Add the Answer
        $answer = new Answer();
        $answer->question_id = $id;
        $answer->answer_owner_id = Auth::user()->id;
        $answer->content = $request->text;
        $answer->date = Carbon::now();
        $answer->save();

        $number_answer = Question::find(intval($id))->number_answer;

        if( $request->counter + 1 < $number_answer){
            return response()->json(array('success' => true, 'number_answers' => $number_answer));
        }

        // Return the changed view
        $response = view('partials.common.answer-card', ['answer' => $answer])->render();
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


    public function editAnswer(Request $request, $id)
    {
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
        $question = Question::find(intval($answer->question_id));
        return response()->json(array('success' => true, 'number_answers' => $question->number_answer, 'content' => $request->text, 'answer_id' => $id));
    }

    private function getAnswers(Question $question){
        return (Auth::check() && Auth::user()->isAdmin() || Auth::user()->isModerator() ? $question->answers() : $question->answersNotDeleted())
            ->orderBy('score','DESC')->orderBy('id', 'DESC');
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
