@extends('layout')

@section('header')

    <li><a href="login">Вход</a></li>
    <li class="active"><a href="register">Регистрация</a></li>

@stop
@section('content')

    <div class="container">
        @if ($errors->all())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h1>Регистрация</h1>
        {{ Form::open(array('url' => '/register', 'role' => 'form', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('name', 'Имя', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('login', 'Логин', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('login', null, array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('phone', 'Телефон', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('phone', null, array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('add_phone', 'Дополнительный телефон', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::text('add_phone', null, array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('email', 'E-Mail', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::email('email', null, array('class' => 'form-control')) }}
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
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
            </div>
        </div>

        {{ Form::close() }}

    </div>

@stop