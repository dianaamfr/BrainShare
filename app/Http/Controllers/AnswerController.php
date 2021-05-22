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

    
    public function newAnswer(Request $request, $id){
        
        // Authorization
        //if(!$this->authorize('create', Answer::class)) return redirect('login');
        
        // Validate the parameters of the request (TODO: Check if this is ok)
        $validated = $request->validate([
            'text' => 'required'
        ]);

        

        // Add the answer to the database (Id has default value, hence should be omissible)
        $answer = new Answer;
        $answer->question_id = $id;
        $answer->answer_owner_id = Auth::user()->id;
        $answer->content = $request->text;
        $answer->save();

        
        // Get the quuestion in order to find all the answers again
        $question =  Question::find(intval($id));
        $answers = $question->answers;

        return response()->json($answers);

        /*
        $response = view('partials.answers', ['answer' => $answers])->render();
        return response()->json(array('success' => true, 'html' => $response));
        
            */
        //return response()->json(['success' => 'true']);
        
    }


}
