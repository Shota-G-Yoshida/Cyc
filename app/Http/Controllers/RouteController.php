<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function search()
    {
        return view('maps/search')->with(['url' => url()->previous()]);
    }
    
    public function route(Request $request)
    {
        $myKey = config('services.googlemap.apikey');
        
        $origin = $request['from'];
        $destination = $request['to'];
        
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $origin . "&destination=" . $destination . "&key=" . $myKey;
        
        $contents= file_get_contents($url);
        $jsonData = json_decode($contents,true);
        
        $distance = (float)substr($jsonData['routes'][0]['legs'][0]['distance']['text'], 0, -3);
        
        if($distance <= 20) {
            $level = '難易度：★☆☆☆☆';
        } elseif($distance <= 40) {
            $level = '難易度：★★☆☆☆';
        } elseif($distance <= 60) {
            $level = '難易度：★★★☆☆';
        } elseif($distance <= 80) {
            $level = '難易度：★★★★☆';
        } else {
            $level = '難易度：★★★★★';
        }
        
        return view('maps/route')->with(['key' => $myKey, 'level' => $level, 'from' => $origin, 'to' => $destination]);
    }

}
