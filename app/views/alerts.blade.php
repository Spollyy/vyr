@extends('layout')
@section('additional')
    {{ HTML::script('extensions/js/jquery-ui.min.js'); }}
    {{ HTML::style('extensions/css/jquery-ui.min.css'); }}

@stop
@section('header')

    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li class="active"><a href="{{route('get_alerts')}}">Alerts</a></li>
@stop
@section('content')

    <h1>Alerst!</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <td>#</td>
            <td>Кто</td>
            <td>Адрес (Google maps)</td>
            <td>Когда
                <div class="input-group date" id="sandbox-container">
                    {{ Form::open(array('url' => '/alerts')) }}
                    <input type="text" id="date" name="date">
                    {{Form::submit('Sort',array('class' => 'btn btn-default btn-sm'))}}
                </div>
            </td>
            <td>Сообщение</td>
        </tr>
        @if (Auth::user()->is_admin)
            @foreach($alerts as $alert)

                <tr>
                    <td>{{$alert->id}}</td>
                    <td>{{User::find($alert->author_id)->name}}</td>
                    <td>
                        <a href="https://www.google.ru/maps?q={{$alert->lat}},{{$alert->lng}}">{{json_decode(file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$alert->lat.','.$alert->lng.'&sensor=false&region=ru'))->results[0]->formatted_address}}</a>
                    </td>
                    <td>{{$alert->created_at}}</td>
                    <td>{{$alert->msg}}</td>
                </tr>
            @endforeach
        @else
            @foreach($alerts as $alert)
                @if($alert->author_id == Auth::user()->id)
                    <tr>
                        <td>{{$alert->id}}</td>
                        <td>{{User::find($alert->author_id)->name}}</td>
                        <td>
                            <a href="https://www.google.ru/maps?q={{$alert->lat}},{{$alert->lng}}">{{json_decode(file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$alert->lat.','.$alert->lng.'&sensor=false&region=ru'))->results[0]->formatted_address}}</a>
                        </td>
                        <td>{{$alert->created_at}}</td>
                        <td>{{$alert->msg}}</td>
                    </tr>
                @endif
            @endforeach
        @endif
    </table>
    <script>
        $('#date').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    </script>
@stop

