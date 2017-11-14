<?php

namespace App\Http\Controllers;

use \App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(){
    	if(auth()->check()){
            return 'Nice try hacker.'
        }

    	$this->validate(request(),[
    			'content'=>'required|min:3|max:150',
    		]);

    	$comment = new Comment();
    	$comment->body=request('content');
    	$comment->user_id=auth()->user()->id;
    	$comment->post_id=request('postId');
    	$comment->save();

    	return redirect()->back();
    }
}
