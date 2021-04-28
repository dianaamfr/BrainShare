<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Search tags
     *
     * @return Response
     */
    public function search(Request $request)
    {
      $tags = Tag::where('name', 'ILIKE', $request->input('tag-input') . '%')->get();
      return response()->json(['tags' => $tags]);
    }

}
