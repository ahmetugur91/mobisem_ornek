@extends("layouts.app")
@section("title","Lokasyon Düzenle")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lokasyon Düzenle</div>
                    <div class="card-body">
                        <div class="form-group">
                            <a href="{{route("location.index")}}" class="btn btn-primary"><i class="icon icon-arrow-left"></i> Lokasyonlara Geri Dön</a>
                        </div>

                        <form action="{{route("location.update",$location)}}" method="POST">
                            @csrf
                            {{method_field("PUT")}}

                            <div class="form-group">
                                <label for="name">Lokasyon Adı</label>
                                <input id="name" name="name" value="{{$location->name}}" class="form-control @error('name') is-invalid @enderror"/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="city">Şehir</label>
                                <input id="city" name="city" value="{{$location->city}}" class="form-control @error('city') is-invalid @enderror"/>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="district">İlçe</label>
                                <input id="district" name="district" value="{{$location->district}}" class="form-control @error('district') is-invalid @enderror"/>
                                @error('district')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lat">Latitude</label>
                                <input id="lat" name="lat" value="{{$location->detail->lat}}" class="form-control @error('lat') is-invalid @enderror"/>
                                @error('lat')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lng">Longitude</label>
                                <input id="lng" name="lng" value="{{$location->detail->lng}}" class="form-control @error('lng') is-invalid @enderror"/>
                                @error('lng')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="button" onclick="getPosition()" class="btn btn-info btn-sm"><i class="icon icon-map-marker"></i> Şuanki Pozisyonumu Al</button>
                            </div>

                            <div class="form-group" style="width: 100%;height: 400px">
                                <div id="map"></div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success btn-block">Kaydet</button>
                            </div>

                        </form>

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
                setForm(event.latLng.lat(), event.latLng.lng());
            });
        }

        // to get real coordinate from the browser
        function getPosition() {
            // Try HTML5 geolocation.
            infoWindow = new google.maps.InfoWindow;
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {

                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    setForm(pos.lat, pos.lng);

                    infoWindow.setPosition(pos);

                    map.setCenter(pos);
                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        //put a marker on map
        function setMarker(lat, lng) {
            var marker = new google.maps.Marker({
                position: {lat, lng},
                map: map,
            });

            markers.push(marker);
        }

        //transfer to form
        function setForm(lat, lng) {

            $("#lat").val(lat);
            $("#lng").val(lng);

            for (let i = 0; i < markers.length; i++) markers[i].setMap(null);

            setMarker(lat, lng);


            var latlng;
            latlng = new google.maps.LatLng(lat, lng);

            // get city and distrcit names.
            new google.maps.Geocoder().geocode({'latLng': latlng}, function (results, status) {

                var components = results[0]["address_components"];

                $("#city").val(components[4]["long_name"]);
                $("#district").val(components[3]["long_name"]);
            });

        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiuLQurCBn_M9Qk5wpS7_fe-z63qKMyEg&callback=initMap" async defer></script>
@endsection
