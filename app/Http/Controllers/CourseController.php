<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController
{
    public function search(Request $request){

    }

    public function addCourse(Request $request){
        $course = new Course();
        $jsonCourse = json_decode($request->getContent(), true);
        $course->name = $jsonCourse['input'];
        $course->setAttribute('creation_date', Carbon::now());
        $course->save();
        return response()->json(['category'=>$course]);
    }

}
