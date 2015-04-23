@extends('layout')
@section('header')
    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li class="active"><a>Редактирование группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>
@stop

@section('content')

    <div class="container">
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

        <h1>Редактор группы</h1>
        {{ Form::open(array('url' => route('edit_group', $id), 'method' => 'put','role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}

        <div class="form-group">
            {{ Form::label('name', 'Название группы', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('name',Group::find($id)->name, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('file','Фото группы',array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::file('file','', array('id'=>'file','class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Описание', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::textarea('description',Group::find($id)->description, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary">Обновить информацию</button>
            </div>
        </div>

        {{ Form::close() }}

    </div>

@stop