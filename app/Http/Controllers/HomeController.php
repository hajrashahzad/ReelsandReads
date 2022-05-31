<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function listdisplay(){
       $username = session('username');
       $movielist = DB::select('SELECT photoURL, title FROM items WHERE item_type = ? and item_id IN (SELECT movie_id FROM movielist WHERE username = ?)', ['movie',$username]);
       $booklist = DB::select('SELECT photoURL, title FROM items WHERE item_type = ? and item_id IN (SELECT book_id FROM booklist WHERE Username = ?)', ['book', $username]);
       $animelist = DB::select('SELECT photoURL, title FROM items WHERE item_type = ? and item_id IN (SELECT anime_id FROM animelist WHERE Username = ?)', ['anime', $username]);
       return view('home', ['movielist' => $movielist, 'booklist' => $booklist, 'animelist' => $animelist, 'username'=>$username]);
    }
    public function infodisplay(){
        $title =$_GET['id'];
        $type = DB::table('items')->where('title', '=', $title)->value('item_type');
        $itemID = DB::table('items')->where('title', '=', $title)->value('item_id');
        $basicinfo = DB::table('items')->select( 'photoURL', 'online_ratings', 'yearOfRelease')->where('title', '=', $title)->get();
        $reviews = DB::select('SELECT * FROM reviews WHERE item_id = ?', [$itemID]);

        foreach ($basicinfo as $info){
            $ratings = $info->online_ratings;
            $RelYear = $info->yearOfRelease;
            $photoURL = $info->photoURL;
        }

        if($type == 'movie'){
          $genres = DB::select('SELECT genre from genres where genre_id in (select genre_id from item_genres where item_id = ?)', [$itemID]);
          $genrelist = '';
          foreach($genres as $g){
            $genrelist = $genrelist.$g->genre.', ';
          }
          $castlist = DB::select('SELECT actor_name from actors where actor_id in (select actor_id from movie_cast where movie_id = ?)', [$itemID]);
          $cast = '';
          foreach($castlist as $c){
              $cast = $cast.$c->actor_name.', ';
          }
          $movieinfo = DB::table('movies')->select('sypnosis', 'runtime', 'director')->where('movie_id', $itemID)->get();
          foreach($movieinfo as $i){
              $sypnosis = $i->sypnosis;
              $runtime = $i->runtime;
              $director = $i->director;
          }
          return view('info', ['title' => $title,'item_type' => $type, 'photoURL'=>$photoURL, 'ratings' =>$ratings, 'yearOfRelease' => $RelYear, 'genres' => $genrelist, 'cast' => $cast, 'sypnosis' =>$sypnosis, 'director' =>$director, 'runtime'=>$runtime,'itemID' =>$itemID, 'reviews'=>$reviews]);
        }
        else if($type == 'book'){
            $authorlist = DB::select('SELECT author_name from authors where author_id in (select author_id from book_authors where book_id = ?)', [$itemID]);
            $authors = '';
            foreach($authorlist as $i){
                $authors = $authors.$i->author_name.', ';
            }
            $tagslist = DB::select('SELECT genre from genres where item_type = ? and genre_id in (select genre_id from item_genres where item_id = ?)', [$type, $itemID]);
            $tags = '';
            foreach($tagslist as $j){
                $tags = $tags.$j->genre.', ';
            }
            $bookinfo = DB::select('SELECT isbn, noOfPgs from books where book_id = ?', [$itemID]);
            foreach ($bookinfo as $k){
                $isbn = $k->isbn;
                $pgs = $k->noOfPgs;
            }
            return view('info', ['title' => $title, 'item_type' => $type,'photoURL'=>$photoURL, 'ratings' =>$ratings, 'yearOfRelease' => $RelYear, 'authors' => $authors, 'tags'=>$tags, 'isbn'=>$isbn, 'pgs'=>$pgs, 'itemID' =>$itemID, 'reviews'=>$reviews]);
        }
        else if($type == 'anime'){
            $genres = DB::select('SELECT genre from genres where item_type = ? and genre_id in (select genre_id from item_genres where item_id = ?)', [$type, $itemID]);
            $genrelist = '';
            foreach($genres as $g){
                $genrelist = $genrelist.$g->genre.', ';
            }
            $animeifo = DB::select('select rank, og_title, overview, noOfEpisodes from anime where anime_id = ?', [$itemID]);
            foreach ($animeifo as $a){
                $rank = $a->rank;
                $og_title = $a->og_title;
                $overview = $a->overview;
                $eps = $a->noOfEpisodes;
            }
            return view('info', ['title' => $title, 'item_type' => $type,'photoURL'=>$photoURL, 'ratings' =>$ratings, 'yearOfRelease' => $RelYear, 'genres' => $genrelist, 'rank'=>$rank, 'og_title'=>$og_title, 'overview'=>$overview, 'eps' =>$eps, 'itemID' =>$itemID, 'reviews'=>$reviews]);
        }
        else{
            return view('info', ['title' => $title,'photoURL'=>$photoURL, 'ratings' =>$ratings, 'yearOfRelease' => $RelYear]);
        }
        
    }
    public function addtolist(Request $req){
        $itemID = $req->input('itemID');
        $addClicked = $req->input('addClick');
        $username = session('username');
        $type = DB::table('items')->where('item_id', '=', $itemID)->value('item_type');
       
        if($addClicked == 'true'){
           // if($c == 0){
                if($type == 'movie'){
                    DB::insert('INSERT into movielist values (?, ?)', [$username, $itemID]);
                }
                else if ($type == 'book'){
                    DB::insert('INSERT into booklist values (?, ?)', [$username, $itemID]);
                }
                else if ($type == 'anime'){
                    DB::insert('INSERT into animelist values (?, ?)', [$username, $itemID]);
                }
                return response()->json(['success'=>'Ajax request submitted successfully']);  
         //   }
        }
        else if ($addClicked == 'false'){
           // if ($c == 1){
                if($type == 'movie'){
                    DB::delete('DELETE from movielist where username = ? and movie_id = ?', [$username, $itemID]);
                }
                else if ($type == 'book'){
                    DB::delete('DELETE from booklist where username = ? and book_id = ?', [$username, $itemID]);
                }
                else if ($type == 'anime'){
                    DB::delete('DELETE from animelist where username = ? and anime_id = ?', [$username, $itemID]);
                }
           // }
           return response()->json(['success'=>'Ajax request submitted successfully']);
        }
    }

    public function saveReview(Request $req) {
        $review = $req->input('review');
        $star = $req->input('star');
        $itemId = $req->input('itemId');
        $username = session('username');
        DB::insert('INSERT INTO reviews VALUES (?, ?, ?, ?)', [$username, $itemId, $review, $star]);
        return response()->json(['success'=>'Ajax request submitted successfully']);
    }
}
