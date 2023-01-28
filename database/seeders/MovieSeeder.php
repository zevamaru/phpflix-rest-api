<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movie = new Movie();
        $movie->name = 'Rocky';
        $movie->genre = 'Drama';
        $movie->director_id = 1;
        $movie->save();
        $movie->actors()->attach(1);

        $movie = new Movie();
        $movie->name = 'Rocky 2';
        $movie->genre = 'Drama';
        $movie->director_id = 1;
        $movie->save();
        $movie->actors()->attach(1);

        $movie = new Movie();
        $movie->name = 'The Last Samurai';
        $movie->genre = 'Drama';
        $movie->director_id = 2;
        $movie->save();
        $movie->actors()->attach(2);
    }
}
