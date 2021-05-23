<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  protected $table = 'answer';

  protected $fillable = ['content', 'deleted'];
  
  public function owner() {
    return $this->belongsTo(User::class, 'answer_owner_id');
  }

  public function comments(){
    return $this->hasMany(Comment::class);
  }

  public function votes(){
    return $this->hasMany(Vote::class);
  }

  public function question() {
    return $this->belongsTo(Question::class, 'question_id');
  }

}
