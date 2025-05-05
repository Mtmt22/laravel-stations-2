<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
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
        Movie::factory(10)->create();

        $this->call([
          SheetsTableSeeder::class,
        ]);
    }
}
