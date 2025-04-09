<?php

namespace Database\Seeders;

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
        // $this->call([
        //     // ここに Seeder を追加する
        // ]);
        // 05 Practiceのテストデータを10個作るSeedファイル
        Practice::factory(10)->create();
        // 以下のコマンドでSeedの実行が可能
        // $ docker compose exec php-container php artisan db:seed
    }
}
