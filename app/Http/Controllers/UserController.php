<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{

    public function deleteUser($id){

      $user = User::find($id);

      // if you are not the user, you cannot delete your profile
      if(Auth::user()->id != $id) return redirect('/user/{'.$id.'}');

      $user->delete();
      
      return view('/home');
    }
}