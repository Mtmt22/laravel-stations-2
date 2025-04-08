<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 01:LaravelでRouteを使ってページを追加しよう
// 「/practice3」にアクセスすると「test」という文字列が返ってくるページ作成
Route::get('/practice3', function () {
  return view('test');
});

// GET /practice でpracticeという文字列を返すこと
Route::get('/practice', function () {
  return 'practice';
});

// GET /practice2 でpractice2という文字列を変数を用いて返すこと
Route::get('/practice2', function () {
  $name = 'practice2';
  return $name;
});
