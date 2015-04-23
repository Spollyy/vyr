@extends('layout')
@section('additional')
    {{ HTML::style('extensions/css/inbox.css'); }}
@stop
@section('header')

    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li class="active"><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>

@stop
@section('content')
    <div class="messages">
        <a href="http://localhost/vyr/public/new_message"
           class="btn btn-success">Написать сообщение</a>

            <?php
            foreach ($message as $msg) {
            if (!empty ($msg)) {
            $from = User::find($msg->from);
            $to = User::find($msg->to);

            ?>
            <div class="msg">
                @if($msg->from == Auth::user()->id)
                    <p>
                        <a href="{{route('show_user',$to->id)}}">{{$to->name}}</a> <br/>
                        <img width=110 src={{asset('uploads/'.$to->file)}}>
                        <img width=60 src={{asset('uploads/'.$from->file)}}>
                        {{$msg->message}}
                    </p>
                    <a href="{{route('new_message', $to->id) }}"
                       class="btn btn-info">Cообщение</a>
                @else
                    <a href="{{route('mess_with',$from->id)}}">{{$from->name}}</a> <br/>
                    <img width=110 src={{asset('/uploads/'.$from->file)}}>
                    {{$msg->message}}<br/>
                    <a href="{{route('new_message',$from->id)}}"
                       class="btn btn-info">Cообщение</a>
                @endif
            </div>
        <?php }} ?>

    </div>
@stop