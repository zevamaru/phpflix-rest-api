<?php

namespace Database\Seeders;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Tvshow;
use Illuminate\Database\Seeder;

class TvshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tvshow = new Tvshow();
        $tvshow->name = 'Breaking Bad';
        $tvshow->genre = 'Drama';
        $tvshow->director_id = 3;
        $tvshow->save();
        $tvshow->actors()->attach(3);
        $tvshow->actors()->attach(4);

        $season = new Season();
        $season->number = 1;
        $season->tvshow_id = 1;
        $season->save();

        $episode = new Episode();
        $episode->name = 'Pilot';
        $episode->number = 1;
        $episode->season_id = 1;
        $episode->save();

        $episode = new Episode();
        $episode->name = "Cat's in the Bag...";
        $episode->number = 2;
        $episode->season_id = 1;
        $episode->save();

        $episode = new Episode();
        $episode->name = "...And the Bag's in the River";
        $episode->number = 3;
        $episode->season_id = 1;
        $episode->save();

        $episode = new Episode();
        $episode->name = 'Cancer Man';
        $episode->number = 4;
        $episode->season_id = 1;
        $episode->save();

        $episode = new Episode();
        $episode->name = 'Gray Matter';
        $episode->number = 5;
        $episode->season_id = 1;
        $episode->save();

        $episode = new Episode();
        $episode->name = "Crazy Handful of Nothin'";
        $episode->number = 6;
        $episode->season_id = 1;
        $episode->save();

        $episode = new Episode();
        $episode->name = 'A No-Rough-Stuff-Type Deal';
        $episode->number = 7;
        $episode->season_id = 1;
        $episode->save();

        $season->episodes()->attach(1);
        $season->episodes()->attach(2);
        $season->episodes()->attach(3);
        $season->episodes()->attach(4);
        $season->episodes()->attach(5);
        $season->episodes()->attach(6);
        $season->episodes()->attach(7);

        $season = new Season();
        $season->number = 2;
        $season->tvshow_id = 1;
        $season->save();

        $season = new Season();
        $season->number = 2;
        $season->tvshow_id = 1;
        $season->save();

        $season = new Season();
        $season->number = 4;
        $season->tvshow_id = 1;
        $season->save();

        $season = new Season();
        $season->number = 5;
        $season->tvshow_id = 1;
        $season->save();

        $tvshow->seasons()->attach(1);
        $tvshow->seasons()->attach(2);
        $tvshow->seasons()->attach(3);
        $tvshow->seasons()->attach(4);
        $tvshow->seasons()->attach(5);
    }
}
