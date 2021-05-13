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
        $this->authorize('showTags', Tag::class);
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
        $this->authorize('addTag', Tag::class);
        $tag = new Tag();
        $jsonTag = json_decode($request->getContent(), true);
        $tag->name = $jsonTag['input'];
        $tag->setAttribute('creation_date', Carbon::now());
        $tag->save();

        return response()->json(['success'=> 'Your request was completed', 'url'=> '/admin/categories/tags']);

    }

    public function deleteTag(Request $request){
        
        $this->authorize('deleteTag', Tag::class);
        $jsonTag = json_decode($request->getContent(), true);
        DB::table('tag')->where('name', "=", $jsonTag['input'])->delete();

        return response()->json(['success'=> 'Your request was completed', 'url'=> '/admin/categories/tags']);

    }


    // COURSES
    public function showCourses(Request $request){
        $this->authorize('showCourses', Course::class);
        $tags = $this->getFilteredCourses($request->input('search-name'));

        return view('pages.manage-courses', ['courses' => $tags->paginate(5), 'url'=> '/admin/categories/courses']);
    }

    public function searchCourses(Request $request): \Illuminate\Http\JsonResponse {
        // TODO: add authorization
        $courses= $this->getFilteredCourses($request->input('search-name'));

        return response()->json(['success'=> 'Your request was completed', 'url'=> '/admin/categories/courses',
            'html' => view('partials.management.category.table', ['categories' => $courses->paginate(5)])->render()
        ]);

    }
    public function getFilteredCourses($search){
        // TODO: add authorization
        if (isset($search) && !empty($search)){
            return Course::where('name', 'ILIKE', $search . '%');
        }
        return Course::orderBy('name', 'asc');
    }

    public function addCourse(Request $request){
        $this->authorize('addCourse', Course::class);
        $course= new Course();
        $jsonCourse= json_decode($request->getContent(), true);
        $course->name = $jsonCourse['input'];
        $course->setAttribute('creation_date', Carbon::now());
        $course->save();

        return response()->json(['success'=> 'Your request was completed', 'url'=> '/admin/categories/courses']);

    }

    public function deleteCourse(Request $request): \Illuminate\Http\JsonResponse {
        $this->authorize('deleteCourse', Course::class);
        $jsonCourse = json_decode($request->getContent(), true);
        DB::table('course')->where('name', "=", $jsonCourse['input'])->delete();

        return response()->json(['success'=> 'Your request was completed', 'url'=> '/admin/categories/courses']);
    }



}
