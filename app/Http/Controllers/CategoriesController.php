<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Course;

// TODO : create the authorization for do these actions.
class CategoriesController extends Controller
{
    public function showTags(){
        $tags = Tag::paginate(5);
        return view('pages.manage-tags', ['tags' => $tags]);
    }

    public function showCourses(){
        $courses = Course::paginate(5);
        return view('pages.manage-courses', ['courses' => $courses]);
    }

}
