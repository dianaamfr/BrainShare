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
    public function showTags(){
        $tags = Tag::paginate(5);

        return view('pages.manage-tags', ['tags' => $tags]);
    }
    public function searchTags(Request $request){
        // TODO: add authorization
        $tags = $this->getFilteredTag($request->input('search-name'));

        return $this->getCategoryTable($tags);
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
        return $this->getCategoryTable($tags);
    }

    public function deleteTag(Request $request){
        $jsonTag = json_decode($request->getContent(), true);
        DB::table('tag')->where('name', "=", $jsonTag['input'])->delete();

        $tags = Tag::whereNotNull('name');
        return $this->getCategoryTable($tags);
    }


    public function showCourses(){
        $courses = Course::paginate(5);
        return view('pages.manage-courses', ['courses' => $courses]);
    }

    public function getCategoryTable($category): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success'=> 'Your request was completed',
            'html' => view('partials.management.category.table', ['categories' => $category->paginate(5)])->render()
        ]);
    }

}
