<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\MoviesRepository;

class MoviesController extends Controller
{
    /**
     * Movie Repository instance
     * 
     * @var MoviesRepository
     */
    protected $moviesRepository;

    public function __construct(MoviesRepository $moviesRepository)
    {
        $this->moviesRepository = $moviesRepository;
    }

    public function popularMovies()
    {
        $popularMovies = $this->moviesRepository->getPopularMovies();

        return $popularMovies;
    }

    public function topRatedMovies()
    {
        $topRatedMovies = $this->moviesRepository->getTopRatedMovies();

        return $topRatedMovies;
    }

    public function detailsMovie($movieId)
    {
        $detailsMovie = $this->moviesRepository->getMovieDetails($movieId);

        return $detailsMovie;
    }

    public function similarMovies($movieId)
    {
        $similarMovies = $this->moviesRepository->getSimilarMovies($movieId);

        return $similarMovies;
    }
}
