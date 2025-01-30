<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
                <div class="flex items-center gap-3">
                    <h2 class='title text-xl text-blue-600 font-bold'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
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