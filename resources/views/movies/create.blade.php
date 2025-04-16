<!DOCTYPE html>
<html lang="en">
<body>
  <!-- バリデーションエラー
  error変数の中にエラーメッセージがあるか? -->
  @if ($errors->any())
    <div class="alert alert-danger" style="color: red;">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <!-- エラー時に入力した内容は保存しておきたい -->


  <form method="post" action="{{ route('movies.store') }}">
    @csrf
    <div>
      <label for="title">タイトル：</label>
      <input type="text" id="title" name="title">
    </div>

    <div><!-- 画像URLを取得 -->
      <label for="image_url">画像 ： </label>
      <input type="text" id="image_url" name="image_url">
        <!-- value="{{ old('image')}}" -->
    </div>

    <div><!-- 公開年int -->
      <label for="published_year">公開年 ： </label>
      <input type="number" id="published_year" name="published_year">
    </div>

    <div><!-- ありか無しかのon/offチェックボックス -->
      <label for="is_showing">公開中かどうか ： </label>
      <!-- チェックしないとis_showingが0を送信する -->
      <input type="hidden" name="is_showing" value="0">
      <input type="checkbox" id="is_showing" name="is_showing" value="1">
      <!-- <input type="radio" name="is_showing" value="1">はい
      <input type="radio" name="is_showing" value="0">いいえ -->
    </div>

    <div>
      <label for="description">概要 ： </label>
      <textarea id="description" name="description" rows="4" cols="40"></textarea>
    </div>

    <div>
      <button type="submit">新規登録</button>
    </div>
  </form>
  <!-- メッセージの表示 -->
  @if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
  @endif
</body>
</html>
