<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RecommendationsController;
use Illuminate\Support\Facades\DB;

class RecommendationsController extends Controller
{
    //
    public function displayrecs(){
        return view('recommendations');
    }
}
