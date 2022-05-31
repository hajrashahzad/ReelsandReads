<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreferencesController extends Controller
{
    public function getGenres() {
        $availableGenres = DB::select("select genre_id, genre from genres where item_type='movie' or item_type='anime'");
        return view('registration.preferences', ["availableGenres"=>$availableGenres]);
    }

    public function savePreferences(Request $req) {
        $genreIDs = $req->input('selectedGenreIDs');
        $books = $req->input('books');
        $movies = $req->input('movies');
        $anime = $req->input('anime');
        foreach($genreIDs as $ID) {
            DB::insert('INSERT INTO user_genres VALUES (?, ?)', ['test1', $ID]);
        }
        DB::update('UPDATE users SET books = ? WHERE username = ?', [$books, 'test1']);
        DB::update('UPDATE users SET movie = ? WHERE username = ?', [$movies, 'test1']);
        DB::update('UPDATE users SET anime = ? WHERE username = ?', [$anime, 'test1']);
        return response()->json(['success'=>"AJAX Call done successfully", 'redirectURL'=>'/recommendations']);
    }
}
