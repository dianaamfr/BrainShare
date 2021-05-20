<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Answer;

class CommentController extends Controller
{
    public function addComment(Request $request, $questionID, $answerID){

        // Authorization
        //if(!$this->authorize('create', Comment::class)) return redirect('login');

        // Validation
         $validated = $request->validate([
            'text' => 'required'
         ]);
 
         // Add Comment
         $comment = new Comment;
         $comment->answer_id = $answerID;
         $comment->comment_owner_id = Auth::user()->id;
         $comment->content = $request->text;
         $comment->save();
         
        // Return the changed view
         $answer = Answer::find(intval($answerID));
         $response = view('partials.comments', ['comment' => $answer->comments])->render();
         return response()->json(array('success' => true, 'html' => $response));


        public function deleteComment(Request $request, $commentID){
                
            // Find Comment
            $comment = Answer::find($commentID);
    
            // Authorization
            //$this->authorize('delete', $comment);
            
            // Delete Comment
            $comment->delete();
            
            // Return the chaged view
            $answer =  Answer::find($comment->$answer_id);
            $response = view('partials.comments', ['comment' => $answer->comments])->render();
            return response()->json(array('success' => true, 'html' => $response));
        }


    public function editComment(Request $request, $commentID){

        // Validation
        $validated = $request->validate([
            'text' => 'required'
        ]);
        
        // Find Comment
        $comment = Comment::find(intval($commentID));
        
        // Authorization
        $this->authorize('edit', $comment);
        
        // Edit comment
        $comment->text = $request->text;
        $comment->save();

        // Return view of comments to refresh view
        $answer = Answer::find(intval($comment->$answer_id));
        $response = view('partials.comments', ['comment' => $answer->comments])->render();
        return response()->json(array('success' => true, 'html' => $response));
        
    }

    

  }
