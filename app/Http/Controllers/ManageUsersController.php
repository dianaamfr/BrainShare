<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class ManageUsersController extends Controller
{
    /**
     * Shows the manage users page
     *
     * @return Response
     */
    public function show()
    {
      $users = User::orderBy('username', 'desc');
 
      return view('pages.manage-users', ['users' => $users->paginate(10)]);
    }
  }
