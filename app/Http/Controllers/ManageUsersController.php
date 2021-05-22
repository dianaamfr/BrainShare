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
    public function show(Request $request){
      $this->authorize('showManageUsers',User::class);

      $users = $this->getFilteredUsers($request->input('search-username'));

      return view('pages.manage-users', ['users' => $users->paginate(10)]);
    }

    public function search(Request $request){
      $this->authorize('showManageUsers',User::class);

      $users = $this->getFilteredUsers($request->input('search-username'));
      
      return response()->json([
        'html' => view('partials.management.users.users-table', ['users' => $users->paginate(10)])->render()
      ]);
    }

    public function getFilteredUsers($search){
      if(isset($search) && !empty($search)){
        return User::where('username', 'ILIKE', $search . '%')->orderBy('username', 'asc');
      }

      if(Auth::user()->isModerator()){
        return User::where('user_role','=', 'RegisteredUser')->orderBy('username', 'asc');
      } 
      
      return User::orderBy('username', 'asc');
      
    }

    public function update(Request $request, $id){
      
      $user = User::find($id);
      $this->authorize('updateState', $user);

      // Administrator or Moderator managing their own account
      if($id == Auth::user()->id){
        return response()->json(['error'=>'Invalid action.']);
      } 

      if($request->input('action') == 'admin') $this->updateRole($user, 'Administrator');
      else if ($request->input('action') == 'moderator') $this->updateRole($user, 'Moderator');
      else if ($request->input('action') == 'ru') $this->updateRole($user, 'RegisteredUser');
      else if($request->input('action') == 'ban') $this->updateBan($user, 1);
      else if($request->input('action') == 'unban') $this->updateBan($user, 0);
      else return response()->json(['error'=>'Invalid action']);

      $html = view('partials.management.users.user-actions', ['id' => $user->id, 'role'=> $user->user_role, 'ban'=> $user->ban, 'date' => date('d-m-Y', strtotime($user->signup_date))])->render();
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

      // Avoid deleting the current user
      if($id == Auth::user()->id) {
        return response()->json(['error'=>'Invalid action.']);
      }

      $user->delete();
      
      $users = $this->getFilteredUsers($request->input('search-username'));

      // Verify if the requested page exists
      $npages = ceil($users->count() / 10.0);
      if($request->input('page') > $npages){
        $request->merge(['page' => $request->input('page') - 1]);
      }

      return response()->json(['success'=> 'Your request was completed',
        'html' => view('partials.management.users.users-table', ['users' => $users->paginate(10)])->render()
      ]);
    }
  }
