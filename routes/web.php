<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RecommendationsController;
use App\Http\Controllers\PreferencesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
}); 

//login/ register routes
Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout');
Route::get('/login', 
    function(){
        return view('login', ['message'=>""]);
    });
Route::get('/register', function(){
    return view('register', ['message'=>""]);
});
Route::post('/register', 'App\Http\Controllers\RegisterController@register');
Route::get('/user', 'App\Http\Controllers\UserController@index');

Route::post('/livesearch', 'App\Http\Controllers\RegisterController@livesearch');
Route::get('/home',  [HomeController::class, 'listdisplay']);
Route::get('/recommendations', [RecommendationsController::class, 'displayrecs']);
Route::get('/info', [HomeController::class, 'infodisplay']);
Route::post('info',[HomeController::class, 'addtolist']);
Route::post('search', [SearchController::class, 'searchmedia']);
Route::get('/preferences', 'App\Http\Controllers\PreferencesController@getGenres');
Route::post('/preferences', 'App\Http\Controllers\PreferencesController@savePreferences');
Route::get('/info', [HomeController::class, 'infodisplay']);
Route::post('search', [SearchController::class, 'searchmedia']);

Route::post('/save-review', 'App\Http\Controllers\HomeController@saveReview');