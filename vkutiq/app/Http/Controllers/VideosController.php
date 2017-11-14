<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Videos;
use \App\Like;
use \App\User;
use \App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
	public function store(){
		if(request()->hasFile('video')){
			$storingLocation="public/videos/";
			$formName="video";

            $this->validate(request(),[
                'name'=>'required|min:3|max:8',
                'description'=>'required|min:3|max:40'
            ]);

            //cut the path to get only the hash and extension.
            //[public/video/Ds41zxEsB23X7.mp4 -> Ds41zxEsB23X7.mp4]
			$nameHashed=$this->getFileHashed(request()->file('video')->store('public/videos'),
				$storingLocation,
				$formName);

			$video=new Videos();
			$video->name=request('title');
			$video->description=request('description');
			$video->storage_id=$nameHashed;
			$video->user_id=auth()->user()->id;
			$video->save();

			request()->video->store('public/videos');
			
			return redirect()->back();
		}
		else{
			return "NO VIDEO SELECTED";
		}
	}
    //We can use basename function for this problem, but a little string manipulation never killed nobody.
	public function getFileHashed($file,$storingLocation,$formName){
			//get the current file's path
			$file_url=request()->file($formName)->store($storingLocation);

			//trim the path, and get only the hash and extension.
			//[public/video/Ds41zxEsB23X7.mp4 -> Ds41zxEsB23X7.mp4]
			$file_url=substr($file_url,
				strlen($storingLocation)+1,
				(strlen($file_url)-strlen($storingLocation)+1));

			//get the hash without extension
			$file_url=substr($file_url,0,strpos($file_url,'.'));

			return $file_url;
	}

    public function show($videoId){
        //get the video by hashed storage id
        $video=Videos::where('storage_id',$videoId)->first();

        //get the uploader
        $videoUploader=DB::select('select * from users as u where u.id = ?',[$video->user_id])[0];

        //get the comments that belong to the selected video
        $comments=DB::select('select * from comments as c where c.post_id like ?',[$video->id]);

        $commentUploaders=$this->getCommentsUsers($comments);

        //get the likes that belong to the video
        $likes=DB::select('select * from likes as l where l.post_id like ? and l.type = 1',[$video->id]);

        //get the dislikes
        $dislikes=DB::select('select * from likes as l where l.post_id like ? and l.type = 0',[$video->id]);

        //reload the likes and dislikes of the video
        $video->likes=count($likes);
        $video->dislikes=count($dislikes);
        $video->save();

        //check if there is a logged user
        if(!is_null(auth()->user())){
	        //get the rating, the user gave to the video
	        $alreadyLiked=DB::select("select * from likes as l where l.post_id like ? and l.user_id like ?",[$video->id,auth()->user()->id]);
	        //if the user didnt rate the video , the rate is null.Otherwise, its 1 for like, and 0 for dislike.
	        $alreadyLiked=empty($alreadyLiked)?null:$alreadyLiked[0]->type;
    	}
    	//else if the user isnt logged in , rating is null
    	else{
    		$alreadyLiked=null;
    	}

        return view('sessions.video', compact('video','comments','likes','dislikes','alreadyLiked','videoUploader','commentUploaders'));
    }
    //get the users that posted the comments on the chosen video.
    private function getCommentsUsers($comments){
        $users=[];
        for($count=0;$count<count($comments);$count++){
            $users[$count]=DB::select('select * from users as u where u.id = ?',[$comments[$count]->user_id])[0];
        }
        return $users;
    }

    public function showHome(){
        //if u need testing->
        //$this->test();

    	$mainVideos=DB::select('select * from videos limit 4');
    	$trendingVideos=DB::select('select * from videos where month(created_at) = month(curdate()) order by views limit 2');

    	return view('mainContent')->with('mainVideos',$mainVideos)->with('trendingVideos',$trendingVideos);
    }

    //TEST
    public function test(){
        $testUser=new User;
        $testUser->name='test';
        $testUser->password='test';
        $testUser->email='test@abv.bg';
        $testUser->save();

        $testVideo=new Videos;
        $testVideo->storage_id='Rnt774cL2m5OyYyeznP5cST9NOwX4azqDUVu1uWk';
        $testVideo->user_id='1';
        $testVideo->name='Test';
        $testVideo->description='Some random description';
        $testVideo->likes=1;
        $testVideo->dislikes=0;
        $testVideo->views=15;
        $testVideo->save();

        $testLike=new Like;
        $testLike->type=1;
        $testLike->post_id=1;
        $testLike->user_id=1;
        $testLike->save();

        $testVideo=new Videos;
        $testVideo->storage_id='Rnt774cL2m5OyYyeznP5cST9NOwX4azqDUVu1uWk';
        $testVideo->user_id='1';
        $testVideo->name='Test1';
        $testVideo->description='Some random description';
        $testVideo->likes=0;
        $testVideo->dislikes=0;
        $testVideo->views=5;
        $testVideo->save();

        $testComment=new Comment;
        $testComment->body="Lorem ipsum dolor sit amet.";
        $testComment->post_id='1';
        $testComment->user_id='1';
        $testComment->save();
    }
    //TEST

    public function search(){
    	$input=request('search_input');
    	//get the input

    	$foundedVideos=DB::select('select * from videos where name like ?',['%'.$input.'%']);
    	//get the videos that have the input in their names

    	if(null !==request('filter')){
    		$filter=request('filter');

    		switch($filter){
	    		case 'mostViewed':$foundedVideos=Videos::where('name','LIKE','%'.$input.'%')->orderBy('views','desc')->get();break;
	    		case 'newest':$foundedVideos=Videos::where('name','LIKE','%'.$input.'%')->orderBy('created_at','desc')->get();break;
	    		case 'mostLiked':$foundedVideos=Videos::where('name','LIKE','%'.$input.'%')->orderBy('likes','desc')->get();break;
	    	}
    	}

    	return view('search')->with('foundVideos',$foundedVideos);
    }

    public function ratePost(){
        //check if the submitted button's value is arrowup(1) or arrowdown(0)
        switch(request('rateButton')){
            case '⇧': 
                $type=1;
                break;

            case '⇩': 
                $type=0;
                break;

            default:
                $type=1;
                break;
        }

    	$like = new Like();
    	$like->type=$type;
    	$like->post_id=request('post_id');
    	$like->user_id=auth()->user()->id;
    	$like->save();

    	return redirect()->back();
    }
}
