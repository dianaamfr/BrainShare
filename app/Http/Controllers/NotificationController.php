<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{   
    public function read(Request $request) {
        $notification = Notification::find($request->id);
    
        $this->authorize('valid', $notification);

        if ($notification->viewed) {
            $notification->viewed = false;
        } else {
            $notification->viewed = true;
        }
        $notification->update();

        return response()->json(['success'=> 'Your request was completed', 'viewed' => $notification->viewed, 'id' => $request->id]);
    }
    
    public function delete(Request $request) {
        $notification = Notification::find($request->id);

        $this->authorize('valid', $notification);

        $notification->delete();

        $notification = Notification::where('user_id', Auth::user()->id);

        $size = $notification->orderBy('date', 'DESC')->paginate(5, ['*'], 'page', $request->page)->count();
        
        $response = null;
        if($size == 5) {
            $response = view('partials.header.notification-card', ['notification' => $notification->orderBy('date', 'DESC')->paginate(5, ['*'], 'page', $request->page)->items()[4]])->render();
        }
        
        return response()->json(['success'=> True, 'id' => $request->id, 'response' => $response, 'lastPage' => $notification->paginate(5)->lastPage()]);
    }

    public function load(Request $request) {

        $notification = Notification::where('user_id', Auth::user()->id);
        
        $response = view('partials.header.notification-list', ['notifications' => $notification->orderBy('date', 'DESC')->paginate(5, ['*'], 'page', $request->page)])->render();
        
        return response()->json(['success'=> True, 'id' => $request->page, 'response' => $response, 'lastPage' => $notification->paginate(5)->lastPage()]);
    }
}
