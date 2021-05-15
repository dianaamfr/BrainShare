<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'report';


    protected $fillable = [
        'viewed', 'date', 'user_id', 'reported_id', 'question_id', 'answer_id', 'comment_id'
    ];
    
}
