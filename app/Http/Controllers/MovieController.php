<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
  public function getMovie() {
    // $movies = Movie::all();
    // 20件ずつのページネーション
    $movies = Movie::paginate(20);
    // keywordを空文字で渡し、初期化する
    $keyword = '';
    // showingは規定でallが最初に設定されてる
    $showing = 'all';
    return view('movies.movie', compact('movies', 'keyword', 'showing'));
  }

  // 08 moviesの新規登録画面
  public function getMovieCreate() {
    logger('create画面表示にアクセスしました');
    return view('movies.create');
  }

  // 08 moviesの新規登録の受取
  public function postMovieCreate(Request $request) {

    // 入力内容を検証（バリデーション）する → 空ならエラー
    // 成功したデータだけを validated 配列に格納
    // input() で個別に取得しなくて良い。先に変数に入れず、ミスがあった時点で止めたい。
    $validated = $request->validate([
      // create.blade からの入力データの name= に対応している
      'title' => 'required|unique:movies,title',
      'genre' => 'required',
      'image_url' => 'required|url',
      'published_year' => 'required',
      'is_showing' => 'required|boolean',
      'description' => 'required',
    ],[
      'title.required' => 'タイトルは必須です',
      'genre.required' => 'ジャンルは必須です',
      'title.unique' => 'タイトルはすでに存在します',
      'image_url.required' => '画像URLは必須です',
      'image_url.active_url' => '画像URLは正しい形式ではありません',
      'published_year.required' => '公開年は必須です',
      'description.required' => '概要は必須です',
    ]);

    // DBトランザクションを開始
    // useで DB を使えるようにしておく
    DB::transaction(function () use ($validated) {

      // genres テーブルにある name に存在しない場合、新規に登録する
      // Genreモデルのインスタンス（設計図から作ったもの）を受け取っている
      // モデルは「データベースのテーブル1つ」をプログラム上で扱うためのクラス
      $genre = Genre::firstOrCreate(['name' => $validated['genre']]);

      // Movie を作成して genre に連携させる
      // create()が new Movie() + save() を同時にしてくれる
      // インスタンスの作成、1つずつの絡む登録、保存を同時に
      Movie::create([
        'title' => $validated['title'],
        'genre_id' => $genre->id,
        'image_url' => $validated['image_url'],
        'published_year' => $validated['published_year'],
        'is_showing' => $validated['is_showing'],
        'description' => $validated['description'],
      ]);

    });


    // 保存後にリダイレクトする（例：新規映画登録ページへ）
    // return back()->with('message', '保存しました');
    // 映画一覧にリダイレクトする
    return redirect()
        ->route('movies.movie')
        ->with('message', '登録しました');
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
    $movie = Movie::find($id);
    return view('movies.edit', compact('movie'));
  }

  // 09 更新処理
  public function updateMovie(Request $request, $id) {
    $movie = Movie::find($id);
    // 入力値チェック
    $validated = $request->validate([
      // 入力必須,titleは重複禁止,ただし自分自身のデータならOK（idを指定）
      'title' => 'required|unique:movies,title,' . $movie->id . ',id',
      'genre' => 'required',
      // 実際に存在するかを調べるには active_url を使う
      'image_url' => 'required|url',
      'published_year' => 'required',
      'description' => 'required',
      'is_showing' => 'required|boolean'
    ],[
      'title.required' => 'タイトルは必須です',
      'genre.required' => 'ジャンルは必須です',
      'title.unique' => 'タイトルはすでに存在します',
      'image_url.required' => '画像URLは必須です',
      'image_url.active_url' => '画像URLは正しい形式ではありません',
      'published_year.required' => '公開年は必須です',
      'description.required' => '概要は必須です',
    ]);

    // チェック済みの値を用いて更新
    $movie->update($validated);

    return redirect()
        ->route('movies.movie')
        ->with('message', '更新しました');
    // return redirect()->route('movies.index')->with('message', '更新しました');
  }

  // 10 削除機能
  public function deleteMovie(Request $request ,$id) {
    $movie = Movie::findOrFail($id);
    $movie->delete();
    return redirect()
        ->route('movies.movie')
        ->with('message', '削除しました');
  }

  // 11 検索機能
//  public function searchMovie(Request $request) {
    public function indexMovie(Request $request) {

    // 検索ボックスに入力された値を受取、keywordに格納する
    $keyword = $request->input('keyword',''); // 空文字で初期化
    $isShowing = $request->input('is_showing','all');
    // laravelのデバック
    // dd($isShowing);

    // クエリ準備
    $movies = Movie::query()->with('genre');

    // keywordがあればif文で取得データを絞り込み
    if ($keyword) {
      $movies->where(function($query) use ($keyword){
        // シングルクォートで囲むと文字列として扱う、変数の場合は
        $query->where('title', 'like', "%{$keyword}%")
          ->orWhere('description', 'like', "%{$keyword}%");
      });
      // $movies->where('title', 'like', '%' . $keyword . '%')
      // ->orWhere('description', 'like', '%' . $keyword . '%');
    }
    // is_showingがあればif文で場合分け
    // valueの内容によって取得データの絞り込みを変える
    // 一個前のif文の最後とANDで結合される
    if ($isShowing === '1') {
      // is_showingが1のものだけを取得
      $movies->where('is_showing', 1);
    }elseif ($isShowing === '0') {
      // is_showingが0のものだけを取得
      $movies->where('is_showing', 0);
    }else{
      // その他の場合はフィルタしない

    }
    // dd($movies->get());
    // 検索結果を取得（クエリ実行）
    // $movies = $movies->get();
    // ページネーションした検索結果を取得する(paginateはgetだとLaravelは知ってる)
    // サイト内検索後にページ送りをクリックしても検索内容が引き継がれるようappends()を加える
    $movies = $movies
        ->paginate(20)
        ->appends(['keyword' => $keyword, 'is_showing' => $isShowing]);
    // $movies = $movies->paginate(2);

    // viewファイルへ、一覧表示データとkeywordを返す
    return view('movies.movie', compact('movies', 'keyword', 'isShowing'));
  }

  // 14 映画詳細ページ（リレーションを使わない）
  public function show($id) {

    // 映画の一覧を取得
    $movie = Movie::findOrFail($id);

    // 作品番号を持って、scheduleを確認する
    // Schedule::where()でも良い
    $schedules = DB::table('schedules')
        ->where('movie_id', $movie->id)
        ->orderBy('start_time')
        ->get();

    return view('movies.shows', compact('movie', 'schedules'));
  }

}
