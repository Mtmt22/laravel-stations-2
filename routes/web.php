<?php

use Database\Factories\PracticeFactory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;

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

// 14 映画詳細ページ作成
Route::get('/movies/{id}', [MovieController::class, 'show'])
    ->where('id','[0-9]+')->name('show');


// 13 座席一覧表示
Route::get('/sheets', [SheetController::class, 'indexSheet'])->name('sheets.index');


// 11 getMovieとsearchMovieを統合
Route::get('/movies', [MovieController::class, 'indexMovie'])->name('movies.index');


// 06 「GET /movies」で映画一覧のページをHTMLで返す
// Route::get('/movies', [MovieController::class, 'getMovie']);


// 07 「GET admin/movies」で現在登録されているmoviesの内容を全て出力する
// Route::get('admin/movies', [MovieController::class, 'getMovie'])->name('movies.movie');
Route::get('admin/movies', [MovieController::class, 'indexMovie'])->name('movies.movie');


// 11 検索機能の追加
// Route::get('/admin/movies/search', [MovieController::class, 'searchMovie'])->name('movies.search');


// 08 映画作品リストへの登録画面の作成
Route::get('/admin/movies/create', [MovieController::class, 'getMovieCreate'])->name('movies.create');
// 名前付きルート（name()）があるとURLが変わっても対応しやすい。
// 08 映画作品の登録処理
Route::post('/admin/movies/store', [MovieController::class, 'postMovieCreate'])->name('movies.store');


// 09 映画作品リストの編集画面の作成
// 個別データの表示、idが他のルートの際に間違えて読み込まれ404になるため数字の制約つけた
Route::get('/admin/movies/{id}', [MovieController::class, 'showMovie'])->name('movies.show')
->where('id','[0-9]+');

// 編集画面
Route::get('/admin/movies/{id}/edit', [MovieController::class, 'editMovie'])->name('movies.edit');
// 更新処理
Route::patch('/admin/movies/{id}/update', [MovieController::class, 'updateMovie'])->name('movies.update');


// 10 削除処理
Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'deleteMovie'])->name('movies.delete');








// 04 データベースの取得
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

// 02 RouteとControllerをどちらも使ってみよう
// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);
Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);


// 01:LaravelでRouteを使ってページを追加しよう
// 「/practice3」にアクセスすると「test」という文字列が返ってくるページ作成
// Route::get('/practice3', function () {
//   return view('test');
// });

// GET /practice でpracticeという文字列を返すこと
// Route::get('/practice', function () {
//   return 'practice';
// });

// GET /practice2 でpractice2という文字列を変数を用いて返すこと
// Route::get('/practice2', function () {
//   $name = 'practice2';
//   return $name;
// });
