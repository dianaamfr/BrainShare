<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

// TODO : create the authorization for do these actions.
class CategoriesController extends Controller
{
    public function showTags(Request $request){
        $tags = $this->getFilteredTag($request->input('search-name'));

        return view('pages.manage-tags', ['tags' => $tags->paginate(5), 'url'=> '/admin/categories/tags']);
    }

    public function searchTags(Request $request){
        // TODO: add authorization
        $tags = $this->getFilteredTag($request->input('search-name'));


        return response()->json(['success'=> 'Your request was completed', 'url'=> '/admin/categories/tags',
            'html' => view('partials.management.category.table', ['categories' => $tags->paginate(5)])->render()
        ]);

    }

    public function getFilteredTag($search){
        // TODO: add authorization
        if (isset($search) && !empty($search)){
            return Tag::where('name', 'ILIKE', $search . '%');
        }
        return Tag::orderBy('name', 'asc');
    }

    public function addTag(Request $request){
        $tag = new Tag();
        $jsonTag = json_decode($request->getContent(), true);
        $tag->name = $jsonTag['input'];
        $tag->setAttribute('creation_date', Carbon::now());
        $tag->save();

        $tags = Tag::whereNotNull('name');
        return response()->json(['success'=> 'Your request was completed', 'url'=> '/admin/categories/tags']);

    }

    public function deleteTag(Request $request){
        $jsonTag = json_decode($request->getContent(), true);
        DB::table('tag')->where('name', "=", $jsonTag['input'])->delete();

        $tags = Tag::whereNotNull('name');
        return response()->json(['success'=> 'Your request was completed', 'url'=> '/admin/categories/tags']);

    }


    public function showCourses(){
        $courses = Course::paginate(5);
        return view('pages.manage-courses', ['courses' => $courses]);
    }

}
