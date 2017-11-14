<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function videos(){
        $this->hasMany(Videos::class);
    }
    public function comments(){
        $this->hasMany(Comment::class);
    }
    public function likes(){
        $this->hasMany(Like::class);
    }
    public function avatar(){
        $this->hasMany(Avatar::class);
    }
}
