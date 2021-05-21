<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'notification';

  
  public function owner() {
    return $this->belongsTo(User::class, 'answer_owner_id');
  }
}
