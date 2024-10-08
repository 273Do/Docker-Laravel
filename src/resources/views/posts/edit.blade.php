<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Blog</title>
</head>

<body>
    <h1 class="title">編集画面</h1>
    <div class="content">
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class='content__title'>
                <h2>タイトル</h2>
                <input type='text' name='post[title]' value="{{ $post->title }}">
            </div>
            <div class='content__body'>
                <h2>本文</h2>
                <input type='text' name='post[body]' value="{{ $post->body }}">
            </div>
            <div class="category">
                <h2>Category</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @if($category->id == $post->category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="保存">
            <div class="footer">
                <a href="/posts/{{ $post->id }}">戻る</a>
            </div>
        </form>
    </div>
</body>

</html>