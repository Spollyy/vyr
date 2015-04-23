@extends('layout')
@section ('additional')
    {{ HTML::style('extensions/css/mypage.css'); }}
@stop
@section('header')
    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li class=""><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>
@stop
@section('content')

    <div class="cewl">
        <div class="mainview">
            <h1 style="text-align: center">{{$user->name}}</h1><br/>

            <div class="photo"
                 style="background-image: url('{{asset("uploads/".$user->file)}}'); ">
            </div>
            <div class="information">
                <div class="left">
                    <div class="left creds">

                        <p>Телефон</p>

                        <p>Доп. телефон</p>

                        <p>Адрес</p>
                    </div>
                    <div style="float: right">

                        <p>{{ $user->phone }}</p>

                        <p>{{ $user->add_phone }}</p>

                        <p>{{ $user->city }} ул {{$user->street}} дом {{$user->house}}</p>
                    </div>
                </div>

                <div class="right">
                    <div class="left creds">

                        <p>Спас</p>

                        <p>Спасен</p>

                        <p>Статус</p>
                    </div>
                    <div class="right">

                        <p>{{ $user->save }}</p>

                        <p>{{ $user->being_saved }}</p>

                        <p>{{ $user->status }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="rating left">
            <p><span>Рейтинг</span><img style="float: right"
                                        src="{{asset('extensions/images/rez.jpg')}}"></p>

            <div class="left">
                @if (Session::has('alert'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('alert') }}</p>
                    </div>
                @elseif((isset($alert)))
                    @if($alert)
                        <div class="alert alert-success">
                            <p>{{ $alert }}</p>
                        </div>
                        <a href="{{route('new_message',$user->id)}}"
                           class="btn btn-default">Напиши мне, напиши</a>
                        {{ Form::open(array('url' => route('delete_friend',$user->id), 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                        {{Form::submit('Пшел отседа',array("class"=>"btn btn-danger"))}}
                        {{Form::close()}}
                        <a name="submit" href="{{route('i_save',$user->id)}}"
                           class="btn btn-success go">Я его спас</a>
                        <a href="{{route('he_save',$user->id)}}"
                           class="btn btn-warning go">Он меня спас</a>
                        <a href="{{route('get_add_referance',$user->id)}}"
                           class="btn btn-info">Оставить отзыв</a>

                    @endif
                @else
                    <?php
                    switch ($user->status) {
                        case 'Опекун':
                            echo '<a href="'. route("add_friend",$user->id) . '"  class="btn btn-sm btn-success">Стань моим выручателем, детка</a><br />';
                            break;
                        case 'Опекуемый':
                            echo '<a href="'. route("add_friend",$user->id) . '" class="btn btn-sm btn-danger">Я хочу быть твоим выручателем, детка</a><br />';
                            break;
                        case 'Оба':
                            echo '<a href="'. route("add_friend",$user->id) . '" class="btn btn-sm btn-success">Наверное, мы с тобой подружимся</a><br />';
                            break;
                    }
                    ?>
                @endif
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <h1 style="color: red; text-align: center">ВЫЗВАТЬ ПОМОЩЬ<br/><br/>
        </h1>
            <a class="alerts" href="{{route('get_alert')}}"></a>

    </div>
    <?php
    $pos = 0;
    $neg = 0;
    $neu = 0;
    foreach ($refer as $rf) {
        if ($rf->status == "Позитивная")
            $pos++;
        elseif ($rf->status == "Нейтральная")
            $neu++;
        else
            $neg++;
    }
    ?>
    <div class="referances">

        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#positive" aria-controls="home" role="tab"
                                                          data-toggle="tab">Позитивные ({{$pos}})</a></li>
                <li role="presentation"><a href="#neutral" aria-controls="messages" role="tab" data-toggle="tab">Нейтральные
                        ({{$neu}})</a>
                </li>
                <li role="presentation"><a href="#negative" aria-controls="profile" role="tab" data-toggle="tab">Негативные
                        ({{$neg}})</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="positive">

                    @if(count($refer) > 0)
                        @foreach ($refer as $rf)
                            @if ($rf->status == 'Позитивная')
                                <div class="refer bg-success">
                                    <h4>Оставил <a
                                                href="{{route('show_user',$rf->author_id)}}">{{User::find($rf->author_id)->name}}</a>
                                    </h4>

                                    <p>{{$rf->referance}}</p>
                                    @if ($rf->author_id == Auth::user()->id)
                                        {{ Form::open(array('url' => route('delete_referance',$rf->id), 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal')) }}
                                        {{Form::submit('Удалить отзыв',array("class"=>"btn btn-danger"))}}
                                        {{Form::close()}}
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
                <div role="tabpanel" class="tab-pane" id="neutral">

                    @if(count($refer) > 0)
                        @foreach ($refer as $rf)
                            @if ($rf->status == 'Нейтральная')
                                <div class="refer neutral">
                                    <h4>Оставил <a
                                                href="{{route('show_user',$rf->author_id)}}">{{User::find($rf->author_id)->name}}</a>
                                    </h4>

                                    <p>{{$rf->referance}}</p>
                                    @if ($rf->author_id == Auth::user()->id)
                                        {{ Form::open(array('url' => route('delete_referance',$rf->id), 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal')) }}
                                        {{Form::submit('Удалить отзыв',array("class"=>"btn btn-danger"))}}
                                        {{Form::close()}}
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
                <div role="tabpanel" class="tab-pane" id="negative">

                    @if(count($refer) > 0)
                        @foreach ($refer as $rf)
                            @if ($rf->status == 'Негативная')
                                <div class="refer bg-danger">
                                    <h4>Оставил <a
                                                href="{{route('show_user',$rf->author_id)}}">{{User::find($rf->author_id)->name}}</a>
                                    </h4>

                                    <p>{{$rf->referance}}</p>
                                    @if ($rf->author_id == Auth::user()->id)
                                        {{ Form::open(array('url' => route('delete_referance',$rf->id), 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal')) }}
                                        {{Form::submit('Удалить отзыв',array("class"=>"btn btn-danger"))}}
                                        {{Form::close()}}
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>

        </div>

    </div>
@stop