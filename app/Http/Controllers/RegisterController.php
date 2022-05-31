<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 
class RegisterController extends Controller
{
    public function register(Request $req){
        $msg="";
        $username = $req->input('username');
        $password = $req->input('password');
        $email = $req->input('email');
        $users = DB::select('select * from users WHERE username = ?',[$username]);
        $rows = count($users);
        if( $rows==0){
			// Account doesnt exists and the form data is valid
            DB::insert('insert into users (username,passwd,email) values(?,?,?)' ,
            [$username, $password, $email]);
			// Redirect to preference page
			return redirect('/preferences');
        }
        else{
			$msg = 'Account already exists!';
			return view('register',['message'=>$msg]);
		}
    }

    public function livesearch(Request $req) {
        $username = $req->input('name');
        if($username!=""){
            $user = DB::select('select * from users WHERE username = ?',[$username]);
            $rows = count($user);
            if($rows==0){//username doesnt exist
                return response()->json(['message'=>"AJAX Call Successfull", "content"=>"<p style='color:green;padding:0 5px;'>Valid Username!</p>"]);
                // echo "<p style='color:green;padding:0 5px;'>Valid Username!</p>";
            
            }
            else{    
                return response()->json(['message'=>"AJAX Call Successfull", "content"=>"<p style='color:red;padding:0 5px;'>Username not available!</p>"]);
                // echo "<p style='color:red;padding:0 5px;'>Username not available!</p>";
            }

        }
    }
}
