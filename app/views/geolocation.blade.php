@extends('layout')
@section('additional')
    {{ HTML::style('extensions/css/inbox.css'); }}
    <script src="http://maps.google.com/maps/api/js?sensor=false"
            type="text/javascript"></script>
@stop
@section('header')

    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class="active"><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>

@stop
@section('content')
    <div id="map" style="width: 1900px; height: 900px;"></div>
    <script type="text/javascript">


        var locations = [
            <?php
             foreach ($coords as $cord)
                echo "['".$cord['name']."', ".$cord['lat'].",".$cord['lng']."],";
             ?>
        ];

        var map = new google.maps.Map(document.getElementById('map'), {

            center: new google.maps.LatLng(56.8298199, 60.6214514),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 4
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    </script>
@stop