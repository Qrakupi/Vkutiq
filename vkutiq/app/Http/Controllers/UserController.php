<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avatar;
use App\Videos;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	
    public function show($page){
        $videos=Videos::getPage($page);

    	return view('sessions.profile')->with('videosTitles',$videos);
    }



    public function changeAvatar(){
    	if(request()->hasFile('avatar')){
            //If the current user's previous avatar is not the default one , delete it.
            if(auth()->user()->avatar!='default.jpg'){
                Storage::delete('/public/avatars/'.auth()->user()->avatar);
            }

            //Get the hashed base name of the stored picture (public/avatars/Ds41zxEsB23X7.jpeg -> Ds41zxEsB23X7.jpeg)
            $imageName=basename(request()->file('avatar')->store('public/avatars'));
            auth()->user()->avatar=$imageName;
            auth()->user()->save();

    		return redirect()->back();
    	}
    	else{
    		return "NO PICTURE SELECTED";
    	}
    }

}
    