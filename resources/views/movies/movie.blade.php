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
    {{-- getのときはcsrfは不要 --}}
    {{-- 検索機能 --}}
    <form action="{{ route('movies.index') }}" method="GET" >
      <input type="text" name="keyword" value="{{ $keyword ?? ''}}" >
      <input type="submit" value="検索" />
      <fieldset role="radiogroup">
        <div>
          {{-- 条件 ? 条件が真なら出す値 : 偽なら出す値 --}}
          <input type="radio" id="all" name="is_showing" value="all"
          {{ old('is_showing', $isShowing) === 'all' ? 'checked' : '' }}/>
          <label for="all">すべて</label>
        </div>

        <div>
          <input type="radio" id="playing" name="is_showing" value="1"
          {{ old('is_showing', $isShowing) === '1' ? 'checked' : '' }}/>
          <label for="playing">上映中</label>
        </div>

        <div>
          <input type="radio" id="scheduled" name="is_showing" value="0"
          {{ old('is_showing', $isShowing) === '0' ? 'checked' : '' }}/>
          <label for="scheduled">上映予定</label>
        </div>
      </fieldset>
    </form>

    <table>
      {{-- カラム名 --}}
      <thead>
        <tr>
          <th>タイトル</th>
          <th>ジャンル</th>
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
              <td>{{ optional($movie->genre)->name ?? '未設定' }}</td>
              <td>{{ $movie->image_url }}</td>
              <td>{{ $movie->published_year }}</td>
              <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
              <td>{{ $movie->description }}</td>
              {{-- 編集画面へのリンク --}}
              <td>
                <a href="{{ route('movies.edit', $movie) }}">
                  <button>編集</button>
                </a>
              </td>
              {{-- 削除フォーム --}}
              <td>
                <form method="post" action="{{ route('movies.delete', $movie) }}" >
                  @csrf
                  @method('delete')
                  {{-- 削除前に確認のダイアログ表示する --}}
                  {{-- 確認ダイアログの結果をボタンに反映させるためにreturnが必要 --}}
                  <button type="submit" onclick="return window.confirm('削除しますか?')">削除</button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>

    </table>

  </div>
  {{-- ページネーションでページの選択が出来るようにする --}}
  {{ $movies->links() }}

  {{-- メッセージの表示 --}}
  @if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
  @endif
</body>

<style>
table {
    margin-top : 10px;
    /* セル（<td>）ごとに２重線を１本にまとめる */
    border-collapse:collapse;
  }td {
    padding : 5px;
  }table, th, td {
    /* 枠線を入れる */
    border: 1px solid #000000;
  }td, th {
    /* 表の余白を入れてセルを見やすくさせる */
    padding: 8px 12px;
  }th {
  background-color: #b6b6b6;
  }tr:nth-child(even) {
    /* 偶数行に背景をつける */
    background-color: #eeeeee;
}

</html>
