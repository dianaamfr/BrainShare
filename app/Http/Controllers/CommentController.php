<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

class CommentController extends Controller
{
    public function addComment(){


         // Verify if the add-answer operation is allowed, request a login otherwise
         if(!$this->authorize('create', Comment::class)) return redirect('login');

         // Validate the parameters of the request (TODO: Check if this is ok)
         $validated = $request->validate([
             'answer_id' => 'integer',
             'content' => 'required'
         ]);
 
 
         // Add the answer to the database (Id has default value, hence should be omissible)
         $comment = new Comment;
         $comment->answer_id = $request->answer_id;
         $comment->comment_owner_id = Auth::user()->id;
         $comment->content = $request->content;
         $comment->save();
         
         
         // Get the answer in order to find all the answers and comments again
         $answer Answer::find($request->$answer_id);
         
         $response = view('partials.comment-card', [$answer->comments, 'answer')->render();
         return response()->json(array('success' => true, 'html' => $response));
    }

    public function editComment(){

    }

    public function deleteComment(){

    }

  }
