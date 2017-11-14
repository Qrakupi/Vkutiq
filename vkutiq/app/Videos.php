<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    public function comments(){
    	$this->hasMany(Comment::class);
    }
    public function user(){
    	$this->belongsTo(User::class);
    }
    public function likes(){
        $this->hasMany(Like::class);
    }
    
    //Get the n'th page of videos.
    public static function getPage($page){
        $videosTitles=Videos::where('user_id',auth()->user()->id)
        ->skip(16*($page-1))
        ->take(16)->get();

        return $videosTitles;
    }
}
