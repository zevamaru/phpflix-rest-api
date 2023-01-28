<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public function episodes()
    {
        return $this->belongsToMany(Episode::class, 'seasons_episodes')->select('number', 'name');
    }
}
