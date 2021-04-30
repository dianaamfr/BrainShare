<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'course';

  protected $fillable = ['name', 'creation_date'];
  
  public function questions(){
      return $this->belongsToMany(Question::class, 'question_course');
  }

}
