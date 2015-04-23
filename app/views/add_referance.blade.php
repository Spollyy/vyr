@extends('layout')
@section('additional')
    {{ HTML::style('extensions/css/mypage.css'); }}
@stop
@section('header')
    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class="active"><a>Новый отзыв</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>
@stop

@section('content')

    <h1 style="text-align: center">Отзыв о {{$user->name}}</h1><br/>
    @if (Session::has('alert'))
        <div class="alert alert-success">
            <p>{{ Session::get('alert') }}
        </div>
    @endif
    @if ($errors->all())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {{ Form::open(array('url' => route('post_add_referance', $user->id), 'role' => 'form', 'class' => 'form-horizontal')) }}
    <div class="form-group">
        {{ Form::label('referance','Отзыв',array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-5">
            {{ Form::textarea('referance','',array('id'=>'file','class'=>'form-control')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('status', 'Оценка', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-5">
            <select name="status" id="status" class="form-control">
                <option value="Позитивная" selected>Позитивная</option>
                <option value="Нейтральная">Нейтральная</option>
                <option value="Негативная">Негативная</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Оставить отзыв</button>
        </div>
    </div>

    {{ Form::close() }}
@stop