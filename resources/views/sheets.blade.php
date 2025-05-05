<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sheets</title>
</head>
<body>
  <table>
    <thead>
      {{-- 右方向にセルを結合する --}}
      <tr><th colspan="5">スクリーン</th></tr>
    </thead>
    <tbody>
      @foreach ($sheets as $sheet)
        <tr>
          <td>{{ $sheet->id }}</td>
          <td>{{ $sheet->row }}-{{ $sheet->column }}</td>
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
  }tbody tr:nth-child(even) {
    /* 偶数行に背景をつける */
    background-color: #e8e8e8;
}
</style>

</html>
