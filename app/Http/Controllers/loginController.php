<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function index(){
    	return view('login.login');
    }
    public function verify(Request $req){
               
        $user = DB::table('user')
                    ->where('username', $req->username)
                    ->where('password', $req->password)
					->first();
		
					//print_r($user);

        /*$user = User::where('username', $req->username)
                    ->where('password', $req->password)
                    ->first();*/

    	if(count((array)$user) > 0){
    		$req->session()->put('username', $req->username);
            $req->session()->put('type', $req->username);
            
    		return redirect()->route('home.home');
    	}else{
    		$req->session()->flash('msg', 'invalid username/password');
    		return redirect('/app/login');
    		//return view('login.index');
    	}
    }

}
