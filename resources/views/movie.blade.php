<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <ul>
    @foreach ($movies as $movie)
        <li>タイトル: {{ $movie->title }}</li>
        <ul>画像： {{ $movie->image_url }}</ul>
    @endforeach
    </ul>
</body>
</html>
