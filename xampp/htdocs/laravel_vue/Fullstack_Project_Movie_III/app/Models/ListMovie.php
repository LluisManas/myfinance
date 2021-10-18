<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListMovie extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'list_id'];

    protected $table = 'list_movie';

    /**
     * Get Movie List owner
     */
     public function user() {

        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsToMany(Movie::class, 'list_movie', 'list_id', 'movie_id');
    }
}
