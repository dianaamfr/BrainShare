<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StaticController extends Controller
{
    /**
     * Shows the home page
     *
     * @return Response
     */

    public function showAbout()
    {
      return view('pages.about');
    }

    public function showNotFound()
    {
      return view('errors.404');
    }

    // In A9 implement this in UserController
    public function showProfile($id){
      
      if (!Auth::check()) return redirect('/login');
      //$user = User::find($id);

      return view('/pages.profile');
    }

    public function showEditProfile(){
      return view('pages.edit-profile');
    }

    // In A9 implement this in other controllers
    /*
    public function showTags(){
      return view('pages.manage-tags');
    }

    public function showCourses(){
      return view('pages.manage-courses');
    }
    */

    public function showReports(){
      return view('pages.manage-reports');
    }

    public function showUsers(){
      return view('pages.manage-users');
    }

    public function showCategories(){
      return view('pages.manage-categories');
    }

}
