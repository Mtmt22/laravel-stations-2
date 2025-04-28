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
        Schema::create('movies', function (Blueprint $table) {
            $table->id()->comment('ID');
            // バリデーション（入口チェック）を通過しても登録では1つしかダメ（絶対に重複禁止）
            $table->string('title')->unique()->comment('映画タイトル');
            $table->text('image_url')->comment('画像URL');
            $table->integer('published_year')->comment('公開年');
            // int, tinyintは使えない Laravelドキュメント参照
            $table->boolean('is_showing')->default(false)->comment('上映中かどうか');
            $table->text('description')->comment('概要');
            $table->timestamps();
            // 親 genres(id) を参照する外部キー
            $table->foreignId('genre_id') // UNSIGNED BIGINT 型で作成される
                  ->constrained() // genres テーブルの id を参照する
                  ->cascadeOnDelete() // 親が消えたら子も自動で削除
                  ->comment('ジャンルID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
