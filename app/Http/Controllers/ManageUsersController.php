<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class ManageUsersController extends Controller {
    /**
     * Shows the manage users page
     *
     * @return Response
     */
    public function show()
    {
      $this->authorize('showManageUsers',User::class);

      if(Auth::user()->isModerator()){
        $users = User::where('user_role','=', 'RegisteredUser')->orderBy('username', 'asc');
      } else  $users = User::orderBy('username', 'asc');

      return view('pages.manage-users', ['users' => $users->paginate(15)]);
    }

    public function search(){
      
      $users = User::where('username', 'ILIKE', $request->input('search-username') . '%')->get();
      return view('pages.manage-users', ['users' => $users->paginate(15)]);
    }

    public function update(Request $request, $id){
      
      $user = User::find($id);
      $this->authorize('updateState', $user);

      if($request->input('action') == 'admin') $this->updateRole($user, 'Administrator');
      else if ($request->input('action') == 'moderator') $this->updateRole($user, 'Moderator');
      else if ($request->input('action') == 'ru') $this->updateRole($user, 'RegisteredUser');
      else if($request->input('action') == 'ban') $this->updateBan($user, 1);
      else if($request->input('action') == 'unban') $this->updateBan($user, 0);

      return $user;
    }

    public function updateRole($user, $role){
      $user->user_role = $role;
      $user->save();
    }

    public function updateBan($user, $ban){
      $user->ban = $ban;
      $user->save();
    }

    public function delete(Request $request, $id){
      $user = User::find($id);

      $this->authorize('delete', $user);
      $user->delete();
      
      return $user;
    }
  }
