<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'tag';

  protected $fillable = ['name', 'creation_date'];


  public function questions(){
    return $this->belongsToMany(Question::class, 'question_tag');
  }


}
