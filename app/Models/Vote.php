<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  protected $table = 'vote';

  protected $fillable = ['value_vote'];
  
  public function owner() {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function question(){
    return $this->belongsTo(Question::class, 'question_id');
  }
}
