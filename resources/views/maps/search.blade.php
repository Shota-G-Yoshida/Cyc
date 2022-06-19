<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Google Maps JavaScript API 2点間のルート案内</title>
    </head>
    <body onload="initMap()">
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        <script
         src="https://maps.google.com/maps/api/js?key={{ config('services.googlemap.apikey') }}"></script>
        <script src="{{ asset("js/route.js") }}"></script>

        <form action="/routes/route" method="POST">
            @csrf
            <label>出発地
                <input type="text" id="from" placeholder="国際センター駅（愛知）" name="from">
            </label>
            
            <span>&rarr;</span>
            
            <label>到着地
                <input type="text" id="to" placeholder="五条街園" name="to">
            </label>
            
            <input type="submit" value="ルートを表示">
        </form>
            
        <div id="map" style="width: 400px; height: 400px"></div>
        <br>
        <a href='/'>戻る</a>
        @endsection
    </body>
</html>