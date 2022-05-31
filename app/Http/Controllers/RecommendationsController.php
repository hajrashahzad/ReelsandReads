<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\RecommendationsController;
use Illuminate\Support\Facades\DB;

class RecommendationsController extends Controller
{
    //
    public function displayrecs(){
        $username = session('username');
        $mediatypes = DB::table('users')->select('movie', 'books', 'anime')->where('username','=',$username)->get();
        foreach ($mediatypes as $i){
            $moviebool = $i->movie;
            $bookbool = $i->books;
            $animebool = $i->anime;
        }
        if($moviebool == '1'){
            $movielist = DB::select('SELECT photoURL, title FROM items WHERE item_type = ? and item_id IN (select item_id from item_genres where genre_id in (select genre_id from user_genres where username = ?))', ["movie",$username]);
        }
        else if ($moviebool == 0 || $moviebool == NULL){
            $movielist = DB::select('SELECT photoURL, title from items where item_type = ? and photoURL IS NOT NULL ORDER BY online_ratings DESC LIMIT ?', ['movie', '20']);
        }
        if($animebool == '1'){
            $animelist = DB::select('SELECT photoURL, title FROM items WHERE item_type = ? and item_id IN (select item_id from item_genres where genre_id in (select genre_id from user_genres where username = ?))', ["anime",$username]);
        }
        else if ($animebool == 0 || $moviebool == NULL){
            $animelist = DB::select('SELECT photoURL, title from items where item_type = ? and photoURL IS NOT NULL ORDER BY online_ratings DESC LIMIT ?', ['anime', '20']);
        }
        $booklist = DB::select('SELECT photoURL, title from items where item_type = ? and photoURL IS NOT NULL ORDER BY online_ratings DESC LIMIT ?', ['book', '20']);
        return view('recommendations', ['booklist'=>$booklist, 'movielist'=>$movielist,'animelist'=>$animelist]);
    }
}
