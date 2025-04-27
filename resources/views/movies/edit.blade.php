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

  <form method="post" action="{{ route('movies.update', $movie->id) }}">
    @csrf
    @method('patch')

    <div>
      <label for="title">タイトル : </label>
      <input type="text" id="title" name="title"
      value="{{ old('title', $movie->title) }}" />
    </div>

    <div>
      <label for="genre">ジャンル : </label>
      <input type="text" id="genre" name="genre"
      value="{{ old('genres_id', $movie->genre->name) }}" />
    </div>

    <div>
      <label for="image_url">画像 ： </label>
      <input type="text" id="image_url" name="image_url"
      value="{{ old('image_url', $movie->image_url) }}"/>
    </div>

    <div>
      <label for="published_year">公開年 ： </label>
      <input type="number" id="published_year" name="published_year"
      value="{{ old('published_year', $movie->published_year) }}"/>
    </div>

    <div>
      <label for="is_showing">公開中かどうか : </label>
      <input type="hidden" name="is_showing" value="0">
      <input type="checkbox" id="is_showing" name="is_showing" value="1"
      {{ old('is_showing', $movie->is_showing) ? 'checked' : '' }}/>

    </div>

    <div>
      <label for="description">概要 : </label>
      <textarea id="description" name="description" cols="30" rows="10">{{ old('description', $movie->description) }}</textarea>
    </div>

    <div>
      <button type="submit">更新する</button>
    </div>
  </form>
  <!-- メッセージの表示 -->
  @if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
  @endif
</body>
</html>
