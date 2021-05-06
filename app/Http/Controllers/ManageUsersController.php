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
    public function show(){
      $this->authorize('showManageUsers',User::class);

      if(Auth::user()->isModerator()){
        $users = User::where('user_role','=', 'RegisteredUser')->orderBy('username', 'asc');
      } else  $users = User::orderBy('username', 'asc');

      return view('pages.manage-users', ['users' => $users->paginate(5)]);
    }

    public function search(Request $request){

      if($request->input('search-input') == ''){
        if(Auth::user()->isModerator()){
          $users = User::where('user_role','=', 'RegisteredUser')->orderBy('username', 'asc');
        } 
        else {
          $users = User::orderBy('username', 'asc');
        }
      } 
      else {
        $users = User::where('username', 'ILIKE', $request->input('search-input') . '%');
      }
      
      return response()->json([
        'html' => view('partials.management.users.users-table', ['users' => $users->paginate(5)])->render()
      ]);
    }

    public function update(Request $request, $id){
      
      $user = User::find($id);
      $this->authorize('updateState', $user);

      // Avoid deleting all Administrators
      if($id == Auth::user()->id && Auth::user()->isAdmin() ) {
        return response()->json(['error'=>'You are the only Administrator. To change your role or delete your account you must first promote other Administrator.']);
        $admins = User::where('user_role','Admnistrator')->count();
        if($admins == 1){
          return response()->json(['error'=>'You are the only Administrator. To change your role or delete your account you must first promote other Administrator.']);
        }
      }

      if($request->input('action') == 'admin') $this->updateRole($user, 'Administrator');
      else if ($request->input('action') == 'moderator') $this->updateRole($user, 'Moderator');
      else if ($request->input('action') == 'ru') $this->updateRole($user, 'RegisteredUser');
      else if($request->input('action') == 'ban') $this->updateBan($user, 1);
      else if($request->input('action') == 'unban') $this->updateBan($user, 0);
      else return response()->json(['error'=>'Invalid action']);

      $html = view('partials.management.users.user-actions', ['id' => $user->id, 'role'=> $user->user_role, 'ban'=> $user->ban])->render();
      return response()->json(['success'=> 'Your request was completed', 'id'=> $user->id, 'html' => $html]);
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

      // Avoid deleting all Administrators
      if($id == Auth::user()->id && Auth::user()->isAdmin() ) {
        $admins = User::where('user_role','Admnistrator')->count();
        if($admins == 1){
          return response()->json(['error'=>'You are the only Administrator. To change you\'re role or delete your account
          you must first promote other Administrator.']);
        }
      }
      $user->delete();
      
      return response()->json(['success'=> 'Your request was completed', 'id'=> $user->id]);
    }
  }
