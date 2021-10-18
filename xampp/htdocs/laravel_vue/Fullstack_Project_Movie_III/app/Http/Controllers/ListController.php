<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieList;
use App\Models\ListMovie;
use App\Repository\Eloquent\MoviesRepository;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MoviesRepository $moviesRepository)
    {
        $this->middleware('auth');
        $this->moviesRepository = $moviesRepository;
    }

    /**
     * Show users lists
     */
    public function  showLists()
    {
        $user = auth()->user();
        $lists = MovieList::where('user_id', $user['id'])->get();
        if ($lists) {
            foreach($lists as $key => $list) {
                $moviesInList = ListMovie::where('user_id', $user['id'])->where('list_id', $list['id'])->get();
                $lists[$key]['amount'] = count($moviesInList);
            }
        }

        return response()->json([
            'lists' => $lists
        ]);
    }
    
  
    public function createList(Request $request, MovieList $list)
    {
        $name = $request->name;
        $user = auth()->user();
        
        $list = new MovieList();
        $list->user_id = $user['id'];
        $list->name = $name;
        $list->save();

        return response()->json([
            'message' => 'List Created',
            'list' => $list
        ]);
    }

    public function addMovieToList(Request $request, ListMovie $listMovie)
    {
        $data = $request->all();
        $user = auth()->user();
       
        $listMovie = new ListMovie();
        $listMovie->user_id = $user['id'];
        $listMovie->list_id = $data['listId'];
        $listMovie->movie_id = $data['movieId'];
        $listMovie->save();
        
        return response()->json([
            'message' => 'Movie added successfully your list',
            'data' => $listMovie
        ]);
    }

    public function getMoviesFromList($listId, MoviesRepository $moviesRepository)
    {
        $user = auth()->user();
        $movies = ListMovie::where('list_id', $listId)->where('user_id', $user['id'])->get();
        $moviesFromList = [];
       
        if (count($movies) > 1) {
            foreach ($movies as $movie) {
                $movieDetails = $this->moviesRepository->getMovieDetails($movie['movie_id']);
                $moviesFromList[] = $movieDetails;
            }
        }

        return response()->json([
            'movies' => $moviesFromList
        ]);
    }

    public function deleteList($listId)
    {
        $user = auth()->user();
        $deleteMovies = ListMovie::where('list_id', $listId)->where('user_id', $user['id'])->get();
        

        if (count($deleteMovies) > 0) {
            foreach ($deleteMovies as $movie) {
                $movie->delete();
            }
        }

        $deleteList = MovieList::find($listId)->delete();

        return response()->json([
            'message' => 'You delete successfully the list'
        ]);
    }
}