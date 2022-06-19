<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Blog</title>
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　
        @section('content')
        <h1>投稿する</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h3>目的地</h3>
                <input class="form-control form-control-lg w-25" type="text" name="post[title]"  value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="distance">
                <h3>走行距離</h3>
                <input class="form-control form-control-lg w-25" type="text" name="post[distance]" value="{{ old('post.distance') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.distance') }}</p>
            </div>
            <div class="difficulty">
                <h3>難易度</h3>
                <select name="post[difficulty_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="body">
                <h3>感想</h3>
                
                <textarea class="form-control form-control-lg w-25" name="post[body]" row="3">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="file">
                <h3>画像</h3>
                <input type="file" name="image">
            </div>
            <input type='hidden' name="post[user_id]" value="{{ Auth::user()->id }}">
            <input type="submit" value="投稿"/>
        </form>
        @if($url === url()->current())
            <h4><a href='/'>戻る</a></h4>
        @else
            <h4>[<a href='{{ $url }}'>戻る</a>]</h4>
        @endif
        @endsection
    </body>
</html>