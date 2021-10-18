<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ListController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//movie
Route::get('/api/popular-movies', [MoviesController::class, 'popularMovies']);
Route::get('/api/top-rated-movies', [MoviesController::class, 'topRatedMovies']);
Route::get('/api/movie/{id}', [MoviesController::class, 'detailsMovie']);
Route::get('/api/movie/{id}/similar', [MoviesController::class, 'similarMovies']);

//Movie lists
Route::get('/api/lists', [ListController::class, 'showLists']);
Route::post('/api/create-list', [ListController::class, 'createList']);
Route::post('/api/add-movie-to-list/{id}', [ListController::class, 'addMovieToList']);
Route::get('/api/get-movies-from-list/{id}', [ListController::class, 'getMoviesFromList']);
Route::get('/api/delete-list/{id}', [ListController::class, 'deleteList']);

Route::any('{slug}', function () {
    return view('home');
});
