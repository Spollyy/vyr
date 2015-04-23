@extends('layout')
@section('header')
    <li class="active"><a href="login">Вход</a></li>
    <li><a href="register">Регистрация</a></li>
@stop
@section('content')
    <div class="main_form">
        <h1>Войди</h1>
        @if (Session::has('alert'))
            <div class="alert alert-danger">
                <p>{{ Session::get('alert') }}
            </div>
        @endif
        <form class="form-signin" role="form" action="{{ action('UserController@postLogin') }}" method="post">
            <h2 class="form-signin-heading">Ваши данные</h2>
            {{Form::token()}}
            <input type="text" class="form-control" placeholder="Email" name="email" required autofocus/>
            <input type="password" class="form-control" placeholder="Password" name="password" required/>
            <label class="checkbox">
                <input type="checkbox" name="remember" value="remember-me"> Запомнить меня
            </label><br/>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>

            <a href="remind">Забыли пароль?</a><br/>
            <a href="register">Регистрация</a>
        </form>
    </div>
@stop