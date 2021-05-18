<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Answer;

class CommentController extends Controller
{
    public function addComment(Request $request){


        // Authorization
        if(!$this->authorize('create', Comment::class)) return redirect('login');

        // UPDATE ANSWER TO ONLY SHOW A CERTAIN AMMOUNT OF COMMENTS
        // Request validation
         $validated = $request->validate([
             'answer_id' => 'integer',
             'content' => 'required'
         ]);
 
         // Add comment
         $comment = new Comment;
         $comment->answer_id = $request->input('answer_id');
         $comment->comment_owner_id = Auth::user()->id;
         $comment->content = $request->input('content');
         $comment->save();
         
         
        // Return view of comments to refresh view
         $answer = Answer::find($request->input('answer_id'));
         
         $response = view('partials.comment-card', [$answer->comments, 'answer'])->render();
         return response()->json(array('success' => true, 'html' => $response));
    }


    public function editComment(Request $request){

        // Request validation
        $validated = $request->validate([
            'content' => 'required'
        ]);
        
        // Authorization
        $this->authorize('edit', $comment_id);
        
        // Edit comment
        $comment = Comment::find(intval($request->id));
        $comment->content = $request->content;
        $comment->save();


        // Return view of comments to refresh view
        $answer = Answer::find($comment->$answer_id);
        $response = view('partials.comment-card', [$answer->comments, 'comment'])->render();
        return response()->json(array('success' => true, 'html' => $response));
        
    }

    public function deleteComment(Request $request){

        // Validate the parameters of the request (TODO: Check if this is ok)
        $validated = $request->validate([
            'comment_id' => 'integer',
        ]); 

        $comment = Answer::find($comment_id);

        // Verify if the deelte-answer operation is allowed
        $this->authorize('delete', $comment_id);

        
        // Delete the question from the table
        $comment->delete();
         // Get the quuestion in order to find all the answers again
        
        // Return view of comments to refresh view
        $answer =  Answer::find($comment->$answer_id);
        $response = view('partials.comment-card', [$answer->comments, 'comment'])->render();
        return response()->json(array('success' => true, 'html' => $response));
    }

  }
