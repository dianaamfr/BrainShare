<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'report';


    protected $fillable = [
        'viewed', 'date', 'user_id', 'reported_id', 'question_id', 'answer_id', 'comment_id', 'content'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function reported()
    {
        return $this->belongsTo(User::class, 'reported_id');
    }
    
}
