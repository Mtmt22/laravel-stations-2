<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
  use HasFactory;
  // セキュリティのため、以下のもの以外は代入できません（どの項目なら安全に代入してOKか）
  protected $fillable = ['title', 'description', 'image_url'];
}
