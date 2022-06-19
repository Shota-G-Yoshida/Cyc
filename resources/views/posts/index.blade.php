<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link rel='stylesheet' href='{{ asset("css/index.css") }}' type='text/css'>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        <div class='flex'>
            <div class='left'>
                <h4>タイムライン</h4>
                <div class='posts'>
                    @foreach ($posts as $post)
                        <div class='post'>
                            <h2><a href='/mypage/{{ $post->user->id }}'>{{ $post->user->name }}</a></h2>
                            <p class='title'>
                                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                            </p>
                            <p class='distance'>{{ $post->distance }}</p>
                            <p class='body'>{{ $post->body }}</p>
                            <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                            @if(Auth::user()->id !== $post->user->id)
                                @if($post->users()->where('user_id', Auth::id())->exists())
                                    <div>
                                        <form action="/posts/{{ $post->id }}/unfavorites" method="POST">
                                            @csrf
                                            <input type="submit" value='👍：いいねを取り消す'>
                                        </form>
                                    </div>
                                @else
                                    <div>
                                        <form action="/posts/{{ $post->id }}/favorites" method="POST">
                                            @csrf
                                            <input type="submit" value='👍：いいね'>
                                        </form>
                                    </div>
                                @endif
                            @endif
                            <p>投稿日：{{ $post->created_at }}</p>
                            <p>いいね数：{{ $post->users()->count() }}</p>
                        </div>
                    @endforeach
                </div>
                <div class='pagenate'>
                    {{ $posts->links() }}
                </div>
            </div>
            <div class='right'>
                <div class='Upper_right'>
                    <h4>＞<a href="/routes/search">難易度測定</a></h4>
                    <!--<p>＞<a href="/posts/ranking">コメントランキング</a></p>-->
                    <h4>＞<a href="/mypage/{{ Auth::user()->id }}">マイページ</a></h4>
                </div>
                <div class='Bottom_right'>
                    <h4　class='create'><a href="/posts/create">投稿する</a></h4>
                </div>
            </div>
        </div>
        @endsection
    </body>
</html>