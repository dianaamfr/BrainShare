<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'notification';

  public function type() {
    if($this->answer_id !== null) {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
    else {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
  }

}
