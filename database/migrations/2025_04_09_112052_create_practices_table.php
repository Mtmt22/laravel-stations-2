<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 無名クラスをreturnで返す。ファイル名との一致は不要。
// クラス名の重複や命名の手間が省ける。
// return new class extends Migration

// 名前がついていて管理しやすい。どのファイルがどのテーブルを扱っているかが分かりやすい。
// クラス名とファイル名を一致させる必要ある。
class CreatePracticesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() //: void
    {
        Schema::create('practices', function (Blueprint $table) {
          // テーブル名は practices
          $table->id();
          // 04 データベースのテーブルにタイトルの追加
          $table->text('title')->comment('タイトル');
          $table->timestamps();
        });
        // migrationの実行によって、データベースに反映される。
        // docker compose exec php-container php artisan migrate
    }

    /**
     * Reverse the migrations.
     */
    public function down() //: void
    {
        Schema::dropIfExists('practices');
    }
};
