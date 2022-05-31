<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $req){
        $msg ="";
        $username = $req->input('username');
        $password = $req->input('password');
        $users= DB::select('select * from users WHERE username = ? AND passwd = ?',[$username,$password]);
        $rows = count($users);
        if( $rows==1){
			// Account exists and the form data is valid
            $genres = DB:: select('select genre from genres WHERE genre_id in (select genre_id from user_genres WHERE username = ?)',[$username]);              
                // Create session data, we can access this data in other routes
				session(['user'=>$username]);  
                session(['genres'=>$genres]);  
                session(['animebool'=>$users[0]->anime]); 
                session(['moviebool'=>$users[0]->movie]); 
                session(['booksbool'=>$users[0]->books]);
                // dd($users); 
                // $data=session('animebool');  
                // echo $data; 

			// Redirect to home page
			 return redirect('https://www.youtube.com/watch?v=xvFZjo5PgG0');
        }
        else{
			$msg = 'Incorrect username/password!';
			return view('login',['message'=>$msg]);
		}
    }
    public function logout(Request $req){
        $req->session()->flush();  
        return redirect('/login');
  
    }
}