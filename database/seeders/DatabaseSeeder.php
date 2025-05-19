<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Schedule;
use App\Practice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 05 Practiceのテストデータを10個作るSeedファイル
        // Practice::factory(10)->create();

        Genre::factory(5)->create();
        Movie::factory(10)
          ->create()
          ->each(function (Movie $movie){
              Schedule::factory()
                ->count(4)
                // 映画IDを参照する
                ->state(['movie_id' => $movie->id])
                ->create();
          });

        $this->call([
          SheetsTableSeeder::class,
        ]);
    }
}
