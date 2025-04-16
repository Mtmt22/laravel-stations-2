<!DOCTYPE html>
<html>
<body>
  <h1>{{ $movie->title }}</h1>

  <div>
    <div>{{ $movie->image_url }}</div>
    <div>公開年 : {{ $movie->published_year }}</div>
    <div>上映中(1) / 上映予定(0) : {{ $movie->is_showing }}</div>
    <div>概要 : {{ $movie->description }}</div>
    <div>登録日時 : {{ $movie->created_at }}</div>
    <div>更新日時 : {{ $movie->updated_at }}</div>

  </div>
</body>
</html>
