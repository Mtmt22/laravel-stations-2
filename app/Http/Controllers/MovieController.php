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
    logger('create画面表示にアクセスしました');
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
    // バリデーションを実行して、通過したデータのみを取り出すメソッド
    $validated = $request->validate([
      // 入力必須,titleは重複禁止,ただし自身の編集の場合はスルー
      'title' => 'required|unique:movies,title',
      // 実際に存在するかを調べるには active_url を使う
      'image_url' => 'required|url',
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

  // 09 個別データの表示処理
  public function showMovie($id) {
    // id を利用して、Movie モデルインスタンスを取得
    // 存在しない場合に404を返す
    $movie = Movie::findOrfail($id);
    // 取得したデータをビューに渡す
    return view('movies.show', compact('movie'));
  }

  // 09 編集画面への処理
  public function editMovie($id) {
    $movie = Movie::findOrFail($id);
    return view('movies.edit', compact('movie'));
  }

  // 09 更新処理
  public function updateMovie(Request $request, $id) {
    $movie = Movie::findOrFail($id);
    // 入力値チェック
    $validated = $request->validate([
      // 入力必須,titleは重複禁止,ただし自分自身のデータならOK（idを指定）
      'title' => 'required|unique:movies,title,' . $movie->id . ',id',
      // 実際に存在するかを調べるには active_url を使う
      'image_url' => 'required|url',
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

    // チェック済みの値を用いて更新
    $movie->update($validated);

    return redirect()->route('movies.movie', $id)->with('message', '更新しました');
  }


}
