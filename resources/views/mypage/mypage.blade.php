<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link rel='stylesheet' href='{{ asset("css/mypage.css") }}' type='text/css'>
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　
        @section('content')
        <!--{{ Auth::user()->name }}-->
        <h3 class='top'>マイぺージ</h3>
        <div class='mypage flex'>
            <div class='aaa'>
                <div class='user left'>
                    <h4>プロフィール</h4>
                    <p>名前：{{ $user->name }}</p>
                    <p>
                    <?php
                    $now = date("Ymd");
                    $birthday = str_replace("-", "", $user->age);
                    echo '年齢：' . floor(($now-$birthday)/10000).'歳';
                    ?>
                    </p>
                    @if($user->followed()->count() > 0)
                        <a href='/mypage/{{ $user->id }}/FollowUser'><p>フォロー：{{ $user->followed()->count() }}</p></a>
                    @else
                        <p>フォロー：{{ $user->followed()->count() }}</p>
                    @endif
                    @if($user->following()->count() > 0)
                        <a href='/mypage/{{ $user->id }}/FollowingUser'><p>フォロワー：{{ $user->following()->count() }}</p></a>
                    @else
                        <p>フォロワー：{{ $user->following()->count() }}</p>
                    @endif
                    @if($user->id == Auth::user()->id)
                        <div class='edit'>
                            <p>[<a href='/mypage/{{ $user->id }}/edit'>プロフィールを編集する</a>]</p>
                        </div>
                    @elseif($user->following()->where('followed_user_id', Auth::id())->exists())
                        <form action='/mypage/{{ $user->id }}/unfollow' method='POST'>
                        @csrf
                            <div class='unfollow'>
                                <input type='submit' value='フォローを解除する'>
                            </div>
                        </form>
                    @else
                        <form action='/mypage/{{ $user->id }}/follow' method='POST'>
                        @csrf
                            <div class='follow'>
                                <input type='submit' value='フォローする'>
                            </div>
                        </form>                
                    @endif
                </div>
                <div class='back'>
                    <h4><a href='/'>戻る</a></h4>
                </div>
            </div>
            <div class='right'>
                <h4>過去の投稿</h4>
                <div class='posts'>
                    @foreach($posts as $post)
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
        </div>
        @endsection
    </body>
</html>