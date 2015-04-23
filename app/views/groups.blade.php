@extends('layout')
@section('header')
    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class="active"><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>
@stop
@section('content')
    <h1>Группы</h1>
    <a href="{{route('get_create_group')}}" class="btn btn-success btn-lg">Создать группу</a>
    @foreach ($groups as $group)
        <a href="{{route('group',$group->id)}}">{{$group->name}}</a>
    @endforeach
@stop