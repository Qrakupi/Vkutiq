<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SessionsController extends Controller
{
	public function __construct(){
		$this->middleware('auth')->only('destroy');
		$this->middleware('guest')->only(['show','create']);
	}

    public function create(){

        $this->validate(request(),[
                'name'=>'required|min:3|max:12|exists:users,name',
                'password'=>'required|min:3|max:12'
            ]);

        $user=User::where('name',request('name'))->first();

        if ( \Hash::check(request('password'), $user->password))
        {
            auth()->login($user);

            return redirect()->home();
        }
        
        return redirect()->back();
    }
    public function show(){
    	return view('/sessions/login');
    }
    public function destroy(){
    	auth()->logout();

    	return redirect()->home();
    }
}
