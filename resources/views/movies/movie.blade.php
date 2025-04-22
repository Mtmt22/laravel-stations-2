<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MoviesLisst</title>
</head>
<body>
  <div>
    <!-- getのときは@csrfは不要 -->
    <!-- 検索機能 -->
    <form action="{{ route('movies.index') }}" method="GET" >
      <input type="text" name="keyword" value="{{ $keyword ?? ''}}" >
      <input type="submit" value="検索" />
      <fieldset role="radiogroup">
        <div>
          <input type="radio" id="all" name="is_showing" value="all" checked />
          <label for="all">すべて</label>
        </div>

        <div>
          <input type="radio" id="playing" name="is_showing" value="1" />
          <label for="playing">上映中</label>
        </div>

        <div>
          <input type="radio" id="scheduled" name="is_showing" value="0" />
          <label for="scheduled">上映予定</label>
        </div>
      </fieldset>
    </form>

    <table border="1">
      <!-- カラム名 -->
      <thead>
        <tr>
          <th>タイトル</th>
          <th>画像</th>
          <th>公開年</th>
          <th>上映中かどうか</th>
          <th>概要</th>
        </tr>
      </thead>
      <tbody>
        <!-- データの一覧表示 -->
        @foreach ($movies as $movie)
          <tr>
              <td>{{ $movie->title }}</td>
              <td>{{ $movie->image_url }}</td>
              <td>{{ $movie->published_year }}</td>
              <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
              <td>{{ $movie->description }}</td>
              <!-- 編集画面へのリンク -->
              <td>
                <a href="{{ route('movies.edit', $movie) }}">
                  <button>編集</button>
                </a>
              </td>
              <!-- 削除フォーム -->
              <td>
                <form method="post" action="{{ route('movies.delete', $movie) }}" >
                  @csrf
                  @method('delete')
                  <!-- 削除前に確認のダイアログ表示する -->
                  <button type="submit" onclick="window.confirm('削除しますか?')">削除</button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>

    </table>

  </div>
  <!-- ページネーションでページの選択が出来るようにする -->
  {{ $movies->links() }}

  <!-- メッセージの表示 -->
  @if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
  @endif
</body>

<style>
table {
  margin-top : 10px;
  border-collapse:collapse;
}td {
  padding : 5px;
}
</style>

</html>
