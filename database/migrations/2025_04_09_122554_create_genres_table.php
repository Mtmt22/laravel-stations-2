<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    //   Schema::table('genres', function (Blueprint $table) {
    //     $table->string('name')->unique()->comment('ジャンル名')->change();
    // });
        // すでにgenresテーブルは作成済みだった。unique()制約をつけるだけ
        // genresテーブルを作成
        Schema::create('genres', function(Blueprint $table) {
          // 親の主キー
          $table->id()->comment('ID');
          // 名前は一意でなければいけない
          $table->string('name')->unique()->comment('ジャンル名');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
