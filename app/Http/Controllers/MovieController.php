<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Auth\Events\Validated;

class MovieController extends Controller
{
  public function getMovie() {
    $movies = Movie::all();
    // return response()->json($movies);
    return view('movies.movie', ['movies' => $movies]);
  }

  // 08 moviesの新規登録画面
  public function getMovieCreate() {
    return view('movies.create');
  }

  // 08 moviesの新規登録の受取
  public function postMovieCreate(Request $request) {
    // <input name="title'...> で指定された内容を取得する
    $title = $request->input('title');
    $image_url = $request->input('image_url');
    $published_year = $request->input('published_year');
    $is_showing = $request->boolean('is_showing');
    $description = $request->input('description');

    // 入力内容を検証（バリデーション）する → 空だった場合にエラー
    // booleanはエラーになるから削除した
    $validated = $request->validate([
      // 入力必須,titleは重複禁止
      'title' => 'required|unique:movies,title',
      'image_url' => 'required|active_url',
      'published_year' => 'required',
      'description' => 'required',
      'is_showing' => 'required|boolean'
    ],[
      'title.required' => 'タイトルは必須です',
      'title.unique' => 'タイトルはすでに存在します',
      'image_url.required' => '画像URLは必須です',
      'image_url.active_url' => '画像URLは正しい形式ではありません',
      'published_year.required' => '公開年は必須です',
      'description.required' => '概要は必須です',
    ]);

    // 精査済みのデータを利用する
    $title = $validated['title'];
    $description = $validated['description'];
    $image_url = $validated['image_url'];
    $published_year = $validated['published_year'];
    $is_showing = $validated['is_showing'];

    // 新しい Diary モデルインスタンスを作成
    $movie = new Movie();
    // title と description をセット
    $movie->title = $title;
    $movie->description = $description;
    $movie->image_url = $image_url;
    $movie->published_year = $published_year;
    $movie->is_showing = $is_showing;

    // データベースに保存
    // LaravelのEloquentモデルのメソッド
    $movie->save();

    // 保存後にリダイレクトする（例：新規映画登録ページへ）
    // return back()->with('message', '保存しました');
    // 映画一覧にリダイレクトする
    return redirect()->route('movies.movie')->with('message', '登録しました');
  }


}
