<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Search tags
     * @return Response
     */
    public function search(Request $request)
    {
      $tags = Tag::has('questions')->where('name', 'ILIKE', $request->input('tag-input') . '%')->get();
      return response()->json(['tags' => $tags]);
    }

    public function find(Request $request, $id){
      return Tag::find($id);
    }


}
