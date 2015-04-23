@extends('layout')
@section('header')
    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class="active"><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>
@stop
@section('content')
    @if (Session::has('alert'))
        <div class="alert alert-success">
            <p>{{ Session::get('alert') }}
        </div>
    @else
        @if(count($friends) == 0)
            <p class="alert alert-info">Гарольд говорит у вас НЕТ!! друзей <img
                        src="{{asset('images/yhnf.jpg')}}" width=50></p>
        @endif
    @endif
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="friends" role="tab" data-toggle="tab">Друзья</a>
            </li>
            <li role="presentation"><a href="#guardian" aria-controls="profile" role="tab" data-toggle="tab">Опекуны</a>
            </li>
            <li role="presentation"><a href="#care" aria-controls="messages" role="tab" data-toggle="tab">Опекуемые</a>
            </li>
            @if(count($new_friends) > 0)
                <li role="presentation"><a href="#new" aria-controls="settings" role="tab" data-toggle="tab">Новые
                        завявки (<?= count($new_friends) ?>)</a></li>
            @endif
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="home">
                @if(count($friends) > 0)
                    @foreach ($friends as $fr)
                        <div class="newfriend">
                            <img class="image left" width=110
                                 src="{{ asset('uploads/'.$fr->file)}}">

                            <p><a href="{{route('show_user',$fr->id)}}"><?= $fr->name ?></a></p>
                            <span><?= $fr->status ?></span><br/>

                            <div>
                                {{ Form::open(array('url' => route('delete_friend',$fr->id), 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                                {{Form::submit('Пшел отседа',array("class"=>"btn btn-danger"))}}
                                {{Form::close()}}
                                <a href="{{ route('new_message',$fr->id) }}"
                                   class="btn btn-info">Cообщение</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div role="tabpanel" class="tab-pane" id="guardian">

                @if(count($friends) > 0)
                    @foreach ($friends as $fr)
                        @if ($fr->status == 'Опекун' or $fr->status == 'Оба')
                            <div class="newfriend">
                                <img class="image left" width=110
                                     src="{{ asset('uploads/'.$fr->file)}}">

                                <p><a href="{{route('show_user',$fr->id)}}"><?= $fr->name ?></a></p>

                                <div>
                                    {{ Form::open(array('url' => route('delete_friend',$fr->id), 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                                    {{Form::submit('Пшел отседа',array("class"=>"btn btn-danger"))}}
                                    {{Form::close()}}
                                    <a href="{{ route('new_message',$fr->id) }}"
                                       class="btn btn-info">Cообщение</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>
            <div role="tabpanel" class="tab-pane" id="care">

                @if(count($friends) > 0)
                    @foreach ($friends as $fr)
                        @if ($fr->status == 'Опекуемый' or $fr->status == 'Оба')
                            <div class="newfriend">
                                <img class="image left" width=110
                                     src="{{ asset('uploads/'.$fr->file)}}">

                                <p><a href="{{route('show_user',$fr->id)}}"><?= $fr->name ?></a></p>

                                <div>
                                    {{ Form::open(array('url' => route('delete_friend',$fr->id), 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                                    {{Form::submit('Пшел отседа',array("class"=>"btn btn-danger"))}}
                                    {{Form::close()}}

                                    <a href="{{ route('new_message',$fr->id) }}"
                                       class="btn btn-info">Cообщение</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            @if(count($new_friends) > 0)
                <div role="tabpanel" class="tab-pane" id="new">
                    @foreach ($new_friends as $nf)
                        <div class="newfriend">
                            <img class="image left" width=110
                                 src="{{ asset('uploads/'.$nf->file)}}">

                            <p><a href="{{route('show_user',$nf->id)}}"><?= $nf->name ?></a></p>
                            <span><?= $nf->status ?></span><br/>

                            <div>
                                {{ Form::open(array('url' => route('update_friend',$nf->id), 'method' => 'put', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                                {{Form::submit('Принять',array("class"=>"btn btn-success"))}}
                                {{Form::close()}}
                                {{ Form::open(array('url' => route('delete_friend',$nf->id), 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                                {{Form::submit('Отклонить',array("class"=>"btn btn-danger"))}}
                                {{Form::close()}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
@stop