<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieList extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['name'];

    protected $table = 'list';

     /**
     * Attributes that should be cast to native types
     * 
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    /**
     * Get Movie List owner
     */
     public function user() {

        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsToMany(Movie::class, 'lists_movies', 'list_id', 'movie_id');
    }
}
