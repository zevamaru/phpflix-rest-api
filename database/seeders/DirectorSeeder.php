<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Seeder;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $director = new Director();
        $director->name = 'Silvester Stallone';
        $director->save();

        $director = new Director();
        $director->name = 'Edward Zwick';
        $director->save();

        $director = new Director();
        $director->name = 'Vince Gilligan';
        $director->save();
    }
}
