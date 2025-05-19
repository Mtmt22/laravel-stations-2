<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
  use HasFactory;

  protected $fillable = ['movie_id', 'start_time', 'end_time'];

  protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
  ];

  // 親 Movie への belongsTo
  public function movie()
  {
      return $this->belongsTo(Movie::class);
  }
}
