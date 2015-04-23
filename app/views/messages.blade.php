@extends('layout')
@section('additional')
    {{ HTML::style('extensions/css/inbox.css'); }}
@stop
@section('header')

    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li class=""><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li class="active"><a href="#">Переписка с {{User::find($id)->name}}</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>

@stop
@section('content')
    <div class="messages">
        @foreach ($message as $msg)
            <?php
            $from = User::find($msg->from);
            ?>
            <div class="msg">
                <p>
                    <a href="{{route('show_user',$from->id)}}"><img width=60
                                                                                  src={{asset('uploads/'.$from->file)}}></a>
                    {{$msg->message}}
                </p>

            </div>
        @endforeach
        {{$message->links()}}
    </div>
    {{ Form::open(array('url' => '/sendmessage', 'role' => 'form', 'class' => 'form-horizontal')) }}
    <div class="form-group">
        {{ Form::label('message', 'Ваше сообщение', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-5">
            {{ Form::textarea('message', '', array('class' => 'form-control')) }}
        </div>
        {{ Form::hidden('to',$id) }}
        {{Form::token()}}
    </div>
    <div class="form-group">
        <div class="col-sm-5">
            {{Form::submit('Отправить',array('class' => 'btn btn-default', 'rows' => 1))}}
        </div>
    </div>
    {{Form::close()}}
@stop