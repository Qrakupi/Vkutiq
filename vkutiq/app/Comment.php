<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
    	$this->belongsTo(User::class);
    }
    public function post(){
    	$this->belongsTo(Post::class);
    }
}
