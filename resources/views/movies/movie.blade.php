<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
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
            <!-- <td> -->
              <!-- もし「is_showing」がtrueのときは'上演中'、falseのときは'上演予定'と表示させる。 -->
            <!-- <td>
              @if ($movie->is_showing)
                上演中
              @else
                上演予定
              @endif
            </td> -->
              <!-- {{ $movie->is_showing }} /  -->
            <!-- </td> -->
            <td>{{ $movie->description }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
