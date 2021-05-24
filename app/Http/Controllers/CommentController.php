<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Answer;

class CommentController extends Controller
{
    public function addComment(Request $request, $id){

        // Authorization
        $this->authorize('create', Comment::class);

        // Validation
         $validated = $request->validate([
            'text' => 'required'
         ]);
 
         // Add Comment
         $comment = new Comment;
         $comment->answer_id = $id;
         $comment->comment_owner_id = Auth::user()->id;
         $comment->content = $request->text;
         $comment->save();
         
        // Return the changed view
         $answer = Answer::find(intval($id));
         $response = view('partials.comments', ['comment' => $answer->comments])->render();
         return response()->json(array('success' => true,'number_comments' => count($answer->comments), 'answer_id' => $id, 'html' => $response));

    }

    public function deleteComment($id){
            
        // Find Comment
        $comment = Comment::find($id);

        // Authorization
        $this->authorize('delete', $comment);
        
        // Getting answer ID before deletion
        $answer_id = $comment->answer_id;

        // Delete Comment
        $comment->delete();
        
        // Return the chaged view
        
        $answer = Answer::find(intval($answer_id));
        $response = view('partials.comments', ['comment' => $answer->comments])->render();
        return response()->json(array('success' => true,'number_comments' => count($answer->comments), 'answer_id' => $answer_id, 'html' => $response));
    }


    public function editComment(Request $request, $id){

        // Validation
        $validated = $request->validate([
            'text' => 'required'
        ]);
        
        // Find Comment
        $comment = Comment::find(intval($id));
        
        // Authorization
        $this->authorize('edit', $comment);
        
        // Edit comment
        $comment->content = $request->text;
        $comment->save();

        //return array('success' => true, 'comment' => $comment);

        // Return view of comments to refresh view
        $answer = Answer::find(intval($comment->answer_id));
        $response = view('partials.comments', ['comment' => $answer->comments])->render();
        return response()->json(array('success' => true,'number_comments' => count($answer->comments), 'answer_id' => $answer->id, 'html' => $response));
        
    }

    

  }
