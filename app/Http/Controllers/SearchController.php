<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
    public function searchmedia(Request $req){
        $value = $req->searchbar;
        $value = '%'.$value.'%';
        $list = DB::select('SELECT title, online_ratings, yearOfRelease, photoURL from items where title like ? limit 50', [$value]);
        return view('search', ['list'=>$list]);
    }
}
