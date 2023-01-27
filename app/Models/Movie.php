<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actor;

class Movie extends Model
{
    use HasFactory;

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movies_actors');
    }
}
