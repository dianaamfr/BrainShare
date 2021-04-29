<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'signup_date', 'birthday',
        'name', 'image', 'description', 'score', 'ban', 'course_id',
        'user_role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function questions() {
        return $this->hasMany('App\Models\Question');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function isAdmin() {
        return $this->user_role === 'Administrator';
    }

    public function isModerator() {
        return $this->user_role === 'Moderator';
    }

}
