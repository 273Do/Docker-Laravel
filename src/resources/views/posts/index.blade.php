<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        Index
    </x-slot>

    <body>
        <!-- <a href='/posts/create'>create</a> -->
        <p class="my-2 font-bold">ログイン中ユーザー：{{ Auth::user()->name }}</p>

        <h1>Blog List</h1>

        <div class='posts'>
            @foreach ($posts as $post)
            <div class='post border p-4 my-4'>
                <h2 class='title text-xl text-blue-600 font-bold'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <a class="text-yellow-500" href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                <p class='body'>{{ $post->body }}</p>
                <details class="cursor-pointer">
                    <summary>コメント</summary>
                    @foreach ($post->replies as $reply)
                    <div class="reply">
                        <div class="flex gap-2">
                            <p class="font-bold">{{ $reply->user->name}}</p>
                            <p>{{ $reply->created_at }}</p>
                        </div>
                        <p>{{ $reply->message }}</p>
                    </div>
                    @endforeach
                </details>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500" type="button" onclick="deletePost({{ $post->id }})">delete</button>
                </form>
            </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
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