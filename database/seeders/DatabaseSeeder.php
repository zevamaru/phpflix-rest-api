<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Sebastián';
        $user->email = 'sebastian.camara@gmail.com';
        $user->password = Hash::make('testing');
        $user->save();

        $this->call(ActorSeeder::class);
        $this->call(DirectorSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(TvshowSeeder::class);
    }
}
