<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
  public function getMovie() {
    $movies = Movie::all();
    // return response()->json($movies);
    return view('movie', ['movies' => $movies]);
  }
}
