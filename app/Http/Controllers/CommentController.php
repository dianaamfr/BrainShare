<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

class CommentController extends Controller
{
    public function addComment(){
        $this->authorize('create', Comment::class);
    }

    public function editComment(){

    }

    public function deleteComment(){

    }

  }
