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
        $username = session('username');
        $inRegistration = session('inRegistration');
        if ($inRegistration)
        {
            foreach($genreIDs as $ID) {
                DB::insert('INSERT INTO user_genres VALUES (?, ?)', [$username, $ID]);
            }
            DB::update('UPDATE users SET books = ? WHERE username = ?', [$books, $username]);
            DB::update('UPDATE users SET movie = ? WHERE username = ?', [$movies, $username]);
            DB::update('UPDATE users SET anime = ? WHERE username = ?', [$anime, $username]);
            session()->flush();
            return response()->json(['success'=>"AJAX Call done successfully", 'redirectURL'=>'/login']);
        }
        else
        {
            DB::delete('DELETE FROM user_genres WHERE username = ?', [$username]);
            foreach($genreIDs as $ID) {
                DB::insert('INSERT INTO user_genres VALUES (?, ?)', [$username, $ID]);
            }
            DB::update('UPDATE users SET books = ? WHERE username = ?', [$books, $username]);
            DB::update('UPDATE users SET movie = ? WHERE username = ?', [$movies, $username]);
            DB::update('UPDATE users SET anime = ? WHERE username = ?', [$anime, $username]);
            return response()->json(['success'=>"AJAX Call done successfully", 'redirectURL'=>'/home']);
        }
    }
}
