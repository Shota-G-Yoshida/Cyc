function initMap() {
    var DS = new google.maps.DirectionsService();
    var DR = new google.maps.DirectionsRenderer();
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 35.6585769, lng: 139.7454506} ,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    /* map を DirectionsRendererオブジェクトのsetMap()を使って関連付け */
    DR.setMap(map);
    // function search_route() {
    //     /* 開始地点と目的地点、ルーティングの種類を設定 */
    var from = document.getElementById('from').value;
    var to = document.getElementById('to').value;
     
    var request = {
        origin: from,
        destination: to,
        travelMode: google.maps.TravelMode.WALKING
    };
    DS.route(request, function(result, status) {
        DR.setDirections(result);
    });
    // }
}