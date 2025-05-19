<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies_show</title>
</head>

<body>
  <h1>{{ $movie->title }}</h1>

  <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
  <div>ID : {{ $movie->id }}</div>
  <div>公開年 : {{ $movie->published_year }}</div>
  <div>ジャンル：{{ optional($movie->genre)->name ?? '未設定' }}</div>
  <div>概要 : {{ $movie->description }}</div>
  <div>{{ $movie->is_showing ? '上映中' : '上映予定' }}</div>


  <h2>上映スケジュール</h2>

  <table>
    <thead>
      <tr>
        <th>開始時刻</th>
        <th>終了時刻</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($schedules as $schedule)
        <tr>
          <td>{{ $schedule->start_time }}</td>
          <td>{{ $schedule->end_time }}</td>
        </tr>
      @endforeach
    </tbody>

  </table>


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
