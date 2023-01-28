<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actor = new Actor();
        $actor->name = 'Silvester Stallone';
        $actor->save();

        $actor = new Actor();
        $actor->name = 'Tom Cruise';
        $actor->save();

        $actor = new Actor();
        $actor->name = 'Bryan Cranston';
        $actor->save();

        $actor = new Actor();
        $actor->name = 'Aaron Paul';
        $actor->save();
    }
}
