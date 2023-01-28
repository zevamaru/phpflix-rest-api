<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tvshow extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'tvshows_actors')->select('name');
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'tvshows_seasons')->select('number');
    }
}
