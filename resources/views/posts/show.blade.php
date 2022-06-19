<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        @if(Auth::user()->id === $posts->user->id)
            <form action="/posts/{{ $posts->id }}" id="form_delete" method="POST">
                @csrf
                @method('delete')
                <input type='submit' style='display:none'>
                <p class='delete'><font color='red'>[<span onclick='return deletePost(this);'>投稿を削除する</span>]</font></p>
            </form>
        @endif
        <h1 class="title text-center">
            {{ $posts->title }}
        </h1>
        <div class="content text-center">
            <div class="content__post">
                <h3><a href=''></a></h3>
                <p>{{ $posts->body }}</p>    
            </div>
            <div class='file text-center'>
                @if($posts->image == True)
                    <img src='https://bucketshota.s3.ap-northeast-1.amazonaws.com/img/{{ $posts->image }}' width='100' height='100'>
                @endif
            </div>
        </div>

        <div class='comment text-center'>
            <p>コメント</p>
                @forelse($posts->comment as $comment)
                    <div class='comment_name'>
                        <a href='/mypage/{{ $comment->user->id }}'>
                            <p>{{ $comment->user->name }}</p>                            
                        </a>
                        <p>{{ $comment->comment }}</p>
                    </div>
                @empty
                    <p>まだコメントはありません</p>
                @endforelse
            <form action='/comment' method='POST'>
                @csrf
                <textarea name='comment' placeholder='コメント'></textarea>
                <input type='hidden'name='post_id' value='{{ $posts->id }}'>
                <br>
                <input type='submit' value='コメントする'>
            </form>
        </div>
        <div class="footer text-center">
            @if(Auth::user()->id === $posts->user->id)
                <p class='edit'>[<a href="/posts/{{ $posts->id }}/edit">編集する</a>]</p>
            @endif
            <h4><a href='/'>戻る</a></h4>
        </div>
        <script>
            function deletePost(e) {
                'use strict';
                if(confirm('本当に削除しますか')) {
                    document.getElementById('form_delete').submit();
                }
            }
        </script>
        @endsection
    </body>
</html>