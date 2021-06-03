<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  protected $table = 'comment';

  protected $fillable = ['content', 'deleted', 'date', 'answer_id', 'comment_owner_id'];

  public function owner(){
    return $this->belongsTo(User::class, 'comment_owner_id');
}

  public function answer() {
    return $this->belongsTo(Answer::class, 'answer_id');
  }

}
