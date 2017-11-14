<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\User;

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only(['show','create']);
    }

    public function create(){
    	$this->validate(request(),[
    			'name'=>'required|min:3|max:12',
    			'email'=>'required|email',
    			'password'=>'required|min:3|max:12|confirmed'
    		]);

    	$user=new User;
        $user->name=request('name');
        $user->password=bcrypt(request('password'));
        $user->email=request('email');
        $user->save();

    	auth()->login($user);

    	return redirect()->home();
    }
    public function show(){
    	return view('/sessions/register');
    }
}
