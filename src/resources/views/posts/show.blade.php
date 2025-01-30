<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<x-app-layout>
    <x-slot name="header">
        Show
    </x-slot>

    <body>
        <div class="flex items-center gap-3">
            <h1 class='title text-xl text-blue-600 font-bold'>
                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
            </h1>
            @auth
            @if(Auth::user()->likes()->where('post_id', $post->id)->exists())
            <ion-icon name="heart" class="like-btn cursor-pointer text-pink-500" id={{$post->id}}></ion-icon>
            @else
            <ion-icon name="heart-outline" class="like-btn cursor-pointer" id={{$post->id}}></ion-icon>
            @endif
            <p>{{$post->likes->count()}}</p>
            @endauth
        </div>
        <a class="text-yellow-500" href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>
            </div>
        </div>
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">edit</a>
        </div>
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="button" onclick="deletePost({{ $post->id }})">delete</button>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <hr>
        <div>
            <p>コメント</p>
            <form action="/posts/reply" method="POST">
                @csrf
                <div class="message">
                    <input type="text" name="reply[message]" placeholder="コメントを入力" value="{{ old('reply.message') }}" />
                    <input type="hidden" name="reply[post_id]" value="{{ $post->id }}" />
                    <p class="message__error" style="color:red">{{ $errors->first('reply.message') }}</p>
                </div>
                <input class="cursor-pointer" type="submit" value="コメントを送信" />
            </form>
            <hr>
            <div>
                @foreach ($post->replies as $reply)
                <div class="reply">
                    <div class="flex gap-2">
                        <p class="font-bold">{{ $reply->user->name}}</p>
                        <p>{{ $reply->created_at }}</p>
                    </div>
                    <p>{{ $reply->message }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </body>

</x-app-layout>

<script>
    function deletePost(id) {
        'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>

</html>