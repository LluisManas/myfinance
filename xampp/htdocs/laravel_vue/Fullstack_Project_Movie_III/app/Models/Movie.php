<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

     /**
     * Attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['id', 'title'];

    protected $table = 'movies';

    /**
     * 
     */
    public function movie_list()
    {
        return $this->belongsToMany(MovieList::class, 'list_movie', 'list_movie', 'movie_id');
    }
}
