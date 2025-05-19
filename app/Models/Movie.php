<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
  use HasFactory; // 「このモデルにはファクトリーが存在するよ」モデル名（Movie）＋Factory で探す
  // セキュリティのため、以下のもの以外は代入できません（どの項目なら安全に代入してOKか）
  protected $fillable = ['title', 'description', 'image_url', 'is_showing', 'published_year', 'genre_id'];

  public function genre() {
        return $this->belongsTo(Genre::class);
    }

  public function schedules() {
    return $this->hasMany(Schedule::class);
  }
}
