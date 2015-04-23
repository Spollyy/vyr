@extends('layout')
@section('header')

    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class="active"><a>Редактировать профиль</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>

@stop

@section('content')
    <?php $user_id = Auth::user(); ?>
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

        <h1>Редактировать информацию</h1>
        {{ Form::open(array('url' => route('put_edit_profile', $user_id->id), 'role' => 'form', 'method' => 'put', 'class' => 'form-horizontal', 'files' => true )) }}

        <div class="form-group">
            {{ Form::label('name', 'Имя', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('name', ''.$user_id->name.'', array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('city', 'Город', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('city', $user_id->city, array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('street', 'Улица', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('street', $user_id->street, array('class' => 'form-control')) }}
            </div>
        </div>


            <div class="form-group">
                {{ Form::label('house', 'Дом', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5">
                    {{ Form::text('house', $user_id->house, array('class' => 'form-control')) }}
                </div>
            </div>


        <div class="form-group">
            {{ Form::label('file','Фото',array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::file('file','',array('id'=>'file','class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('phone', 'Телефон', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('phone', $user_id->phone, array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('add_phone', 'Дополнительный телефон', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('add_phone', $user_id->add_phone, array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('password', 'Пароль', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('password_confirmation', 'Повтор пароля', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('status', 'Статус', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                <select name="status" id="status" class="form-control">
                    <option value="Опекуемый" selected>Опекуемый</option>
                    <option value="Опекун">Опекун</option>
                    <option value="Оба">Оба</option>
                </select>
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