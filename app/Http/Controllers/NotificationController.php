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

        return response()->json(['success'=> True, 'id' => $request->id]);
    }
}
