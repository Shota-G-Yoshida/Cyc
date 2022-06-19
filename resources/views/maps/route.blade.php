<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Google Maps JavaScript API 2点間のルート案内</title>
        <link rel='stylesheet' href='{{ asset("css/mypage.css") }}' type='text/css'>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body onload="initMap()">
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        <script
         src="https://maps.google.com/maps/api/js?key={{ config('services.googlemap.apikey') }}"></script>
        <script src="{{ asset("js/route.js") }}"></script>

        <label class=''>出発地
            <input type="text" id="from" value="{{ $from }}" placeholder="国際センター駅（愛知" name='from'>
        </label>
        
        <!--<span>&rarr;</span>-->
        
        <label>到着地
            <input type="text" id="to" value="{{ $to }}" placeholder="五条街園" name='to'>
        </label>
        
        <div id="map" class='pagenate' style="width: 400px; height: 400px"></div>
        
        <h4>{{ $level }}</h4>
        <br>
        <a href='/routes/search'>もう一度測定する</a>
        <br>
        <a href='/'>トップに戻る</a>
        @endsection
    </body>
</html>