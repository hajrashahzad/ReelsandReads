<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function listdisplay(){
        // DB::insert('insert into users (username, passwd,email) values (?,?,?)', [
        //     'haj', 'password','me@gmail.com', 
        // ]);
       // $res = DB::select('SELECT photoURL, title FROM items WHERE item_type = ? and item_id IN (SELECT movie_id FROM movielist WHERE username = ?)', ['movie','test1']);
       $res = DB::table('movielist')->where('username', 'test1')->value('movie_id'); 
       $movielist = DB::table('item')->where('')
       return view('welcome', ['res' => $res]);
    }
}
