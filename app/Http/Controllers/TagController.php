<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

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

    public function addTag(Request $request){
        $tag = new Tag();
        $jsonTag = json_decode($request->getContent(), true);
        $tag->name = $jsonTag['input'];
        $tag->setAttribute('creation_date', Carbon::now());
        $tag->save();
        return response()->json(['category'=>$tag]);
    }

    // make this not be with the api.
    public function deleteTag(Request $request){
        $jsonTag = json_decode($request->getContent(), true);
        $instance = DB::table('tag')->where('name', "=", $jsonTag['input'])->delete();
        return response()->json(['category'=>$instance]);
    }

}
