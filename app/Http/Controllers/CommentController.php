<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Answer;

class CommentController extends Controller
{
    public function showMoreComments(Request $request, $id){
        
        // Validation
        $validated = $request->validate([
            'counter' => 'integer'
        ]);

        $answer =  Answer::find(intval($id));

        $number_comments = count($answer->comments)

        if($request->counter < $number_comments){
            $query = $answer->comments()->offset($request->counter)->get();
            $response = view('partials.common.comment-list', ['comment' => $query])->render();
            return response()->json(array('success' => true,'number_comments' => $number_comments, 'answer_id' => $id, 'html' => $response));
        }
        
        return response()->json(array('success' => false));
    }




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
         $comments = $this->getComments($answer);
         
         $response = view('partials.common.comment-list', ['comments' => $comments])->render();
         return response()->json(array('success' => true,'number_comments' => count($comments), 'answer_id' => $id, 'html' => $response));

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
        $comments = $this->getComments($answer);

        $response = view('partials.common.comment-list', ['comments' => $comments])->render();
        return response()->json(array('success' => true,'number_comments' => count($comments), 'answer_id' => $answer_id, 'html' => $response));
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
        $comments = $this->getComments($answer);

        $response = view('partials.common.comment-list', ['comments' => $comments])->render();
        return response()->json(array('success' => true,'number_comments' => count($comments), 'answer_id' => $answer->id, 'html' => $response));
        
    }

    private function getComments(Answer $answer){
        return Auth::check() && Auth::user()->isAdmin() || Auth::user()->isModerator() ? $answer->comments : $answer->commentsNotDeleted;
    }

  }
