<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MoviesLisst</title>
</head>
<body>
  <table>
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
            <!-- 削除ボタン -->
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
  <!-- メッセージの表示 -->
  @if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
  @endif
</body>
</html>
