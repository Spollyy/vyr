@extends('layout')
@section('header')

    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li class=""><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li class="active"><a href='#'>Новое Сообщение</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>

@stop
@section('content')
    @if (Session::has('alert'))
        <div class="alert alert-success">
            <p>{{ Session::get('alert') }}</p>
        </div>
    @endif
    {{ Form::open(array('url' => '/sendmessage', 'role' => 'form', 'class' => 'form-horizontal')) }}
    <div class="form-group">
        <div class="col-sm-5">
            <h4>Собеседник</h4>
            <select name="to">
                @foreach($friends as $friend)
                    {{var_dump($friend->friend_id)}}
                    <option value="{{$friend->friend_id}}">{{User::find($friend->friend_id)->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('message', 'Ваше сообщение', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-5">
            {{ Form::textarea('message', '', array('class' => 'form-control')) }}
        </div>
        {{Form::token()}}
    </div>
    <div class="form-group">
        <div class="col-sm-5">
            {{Form::submit('Отправить',array('class' => 'btn btn-default'))}}
        </div>
    </div>
    {{Form::close()}}
@stop