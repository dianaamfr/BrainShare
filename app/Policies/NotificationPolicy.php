<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notification;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class NotificationPolicy{
    use HandlesAuthorization;

    public function valid(User $user, Notification $notification){
      // Only a question owner can mark answers as valid
      return $user->id === $notification->user_id;
  }
}
