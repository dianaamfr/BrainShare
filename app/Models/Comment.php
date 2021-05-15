<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  protected $table = 'comment';

  protected $fillable = ['content'];
  
  public function owner(){
    return $this->belongsTo(User::class, 'comment_owner_id');
}

  public function question() {
    return $this->belongsTo(Answer::class, 'answer_id');
  }

}