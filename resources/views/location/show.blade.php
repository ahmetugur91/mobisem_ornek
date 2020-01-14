@extends("layouts.app")
@section("title","Lokasyon - " . $location->name)
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lokasyon</div>
                    <div class="card-body">

                        <div class="form-group">
                            <a href="{{route("location.index")}}" class="btn btn-primary"><i class="icon icon-arrow-left"></i> Lokasyonlara Geri Dön</a>
                        </div>


                        <div class="form-group">
                            <b>Lokasyon Adı:</b>
                            <span>{{$location->name}}</span>
                        </div>

                        <div class="form-group">
                            <b>Şehir</b>
                            <span>{{$location->city}}</span>
                        </div>

                        <div class="form-group">
                            <b>İlçe</b>
                            <span>{{$location->district}}</span>
                        </div>

                        <div class="form-group">
                            <b>Latitude</b>
                            <span>{{$location->detail->lat}}</span>
                        </div>

                        <div class="form-group">
                            <b>Longitude</b>
                            <span>{{$location->detail->lng}}</span>
                        </div>

                        <div class="form-group" style="width: 100%;height: 400px">
                            <div id="map"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("styles")
    @parent
    <style>
        #map {
            height: 100%;
        }
    </style>
@endsection

@section("scripts")
    @parent

    <script>
        var map;
        var markers = [];

        //init to map div
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{$location->detail->lat}}, lng: {{$location->detail->lng}}},
                zoom: 14
            });

            setMarker({{$location->detail->lat}}, {{$location->detail->lng}});

            google.maps.event.addListener(map, 'click', function (event) {
                return false;
            });
        }

        //put a marker on map
        function setMarker(lat, lng) {
            var marker = new google.maps.Marker({
                position: {lat, lng},
                map: map,
            });

            markers.push(marker);
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiuLQurCBn_M9Qk5wpS7_fe-z63qKMyEg&callback=initMap" async defer></script>
@endsection
