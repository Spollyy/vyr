@extends('layout')
@section('header')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="http://viruchatel.u42697.netangels.ru/public/">
                    <img src="extensions/images/V.png" width=50% style="margin-top: -10px;">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <ul class="nav navbar-nav" style="float:left;">
                <li  ><a href='edit/<?=Auth::user()->id?>'>Редактировать профиль</a></li>
                <li>  <a href="http://viruchatel.u42697.netangels.ru/public/mypage">Моя страница</a></li>
                <li><a href='http://viruchatel.u42697.netangels.ru/public/myinbox'>Сообщения</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout">Выйти({{ Auth::user()->login }})</a></li>
            </ul>
        </div><!-- /.container-fluid -->
    </nav>
@stop
@section('content')
    <div class="main_form">
        <h1>Вы вошли </h1>
    </div>
@stop