<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        <!--{{ Auth::user()->name }}-->
        <h1 class='top'>フォロワー</h1>
        <div class='mypage'>
            @foreach($user as $follow)
                <a href='/mypage/{{ $follow->id }}'>{{ $follow->name }}<br></a>
            @endforeach
            <br>
            @if($url === url()->current())
                <h4><a href='/'>戻る</a></h4>
            @else
                <h4>[<a href='{{ $url }}'>戻る</a>]</h4>
            @endif
        </div>
        @endsection
    </body>
</html>