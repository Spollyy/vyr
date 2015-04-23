@extends('layout')
@section('header')
    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li class=""><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>
    <li class=""><a href='#'>Поиск</a></li>

@stop

@section('content')
    @if (Session::has('alert'))
        <div class="alert alert-success">
            <p>{{ Session::get('alert') }}
        </div>
    @else
        @if(empty($users) && empty($groups))
            <p class="alert alert-info">Гарольд говорит ничего не найдено <img
                        src="{{asset('extensions/images/yhnf.jpg')}}" width=50></p>
        @endif
    @endif
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Общий</a>
            </li>
            <li role="presentation"><a href="#people" aria-controls="people" role="tab" data-toggle="tab">Люди</a>
            </li>
            <li role="presentation"><a href="#group" aria-controls="group" role="tab" data-toggle="tab">Группы</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="home">
                <?php $i = 0 ?>
                <h2>Люди</h2>
                @foreach ($users as $fr)

                    <div class="newfriend">

                        <img class="image left" width=110
                             src="{{asset('uploads/'.$fr->file)}}">

                        <p><a href="{{route('show_user',$fr->id)}}"><?= $fr->name ?></a></p>
                        <span><?= $fr->status ?></span><br/>
                    </div>
                    <?php $i++;
                    if (5 <= $i) {
                        $i = 0;
                        break;
                    }
                    ?>
                @endforeach
                <h2>Группы</h2>
                @foreach ($groups as $fr)

                    <div class="newfriend">

                        <img class="image left" width=110
                             src="{{asset('uploads/'.$fr->file)}}">

                        <p><a href="{{route('group',$fr->id)}}"><?= $fr->name ?></a></p>
                    </div>
                    <?php $i++;
                    if (5 <= $i) {
                        $i = 0;
                        break;
                    }
                    ?>
                @endforeach
            </div>

            <div role="tabpanel" class="tab-pane" id="people">

                @foreach ($users as $fr)
                    <div class="newfriend">
                        <img class="image left" width=110
                             src="{{asset('uploads/'.$fr->file)}}">

                        <p><a href="{{route('show_user',$fr->id)}}"><?= $fr->name ?></a></p>
                        <span><?= $fr->status ?></span><br/>
                    </div>
                @endforeach

            </div>


            <div role="tabpanel" class="tab-pane" id="group">

                @foreach ($groups as $fr)
                    <div class="newfriend">
                        <img class="image left" width=110
                             src="{{asset('uploads/'.$fr->file)}}">

                        <p><a href="{{route('group',$fr->id)}}"><?= $fr->name ?></a></p>
                    </div>
                @endforeach

            </div>

        </div>

    </div>






    <?php
    ?>

@stop