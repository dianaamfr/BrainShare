<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the profile of a user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id){
      
      if (!Auth::check()) return redirect('/login');
      $card = User::find($id);

      return view('/pages.profile');
    }


    public function deleteUser($id){

      $user = User::find($id);

      // if you are not the user, you cannot delete your profile
      if(Auth::user()->id != $id) return redirect('/user/{'.$id.'}');

      $user->delete();
      
      return view('/home');
    }
}