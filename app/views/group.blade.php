@extends('layout')
@section('header')
    <li class=""><a href="{{route('mypage')}}">Моя страница</a></li>
    <li class=""><a href="{{route('show_friends')}}">Мои друзья</a></li>
    <li><a href="{{route('inbox')}}">Сообщения</a></li>
    <li class=""><a href="{{route('geo')}}">Друзья на карте</a></li>
    <li class=""><a href="{{route('groups_list')}}">Мои группы</a></li>
    <li class="active"><a>{{$group->name}}</a></li>
    @if($group->admin_id == Auth::user()->id)
        <li class=""><a href='{{route('get_edit_group', $group->id)}}'>Редактировать
                группу</a></li>
    @endif
    <li><a href="{{route('get_alerts')}}">Alerts</a></li>
@stop
@section('content')
    @if(Usergroup::where('group_id','=',$group->id)->where('user_id','=', Auth::user()->id)->where('confirmed','=',1)->first())
        <div class="groupinfo">
            <img src="{{asset('uploads/'.$group->file)}}" alt=""/>
            <h1>{{$group->name}}</h1>

            <p>{{$group->description}}</p>
        </div>

        @if (count($new_members) && $group->admin_id == Auth::user()->id)
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#members" aria-controls="home" role="tab"
                                                              data-toggle="tab">Пользователи</a></li>
                    <li role="presentation"><a href="#new_members" aria-controls="profile" role="tab" data-toggle="tab">Новые
                            пользователи ({{count($new_members)}})</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="members">
                        <h3>Пользователи</h3>

                        <div class="grop_members">
                            @foreach($members as $member)
                                <div>
                                    <img class="image left" width=60
                                         src="{{ asset('uploads/'.User::find($member->user_id)->file)}}">
                                    <a
                                            href="{{route('show_user',User::find($member->user_id)->id)}}">
                                        <p>{{User::find($member->user_id)->name}}</p></a>

                                </div><br/><br/>
                            @endforeach
                        </div>
                        <br/>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="new_members">
                        <h3>Новые Пользователи</h3>

                        <div class="grop_members">
                            @foreach($new_members as $member)
                                <div>
                                    <img class="image left" width=60
                                         src="{{ asset('uploads/'.User::find($member->user_id)->file)}}">
                                    <a href="{{route('show_user',User::find($member->user_id)->id)}}">
                                        <p>{{User::find($member->user_id)->name}}</p></a>
                                    {{ Form::open(array('url' => '/join/'.$group->id, 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                                    {{Form::hidden('user_id',$member->user_id)}}
                                    {{Form::submit('Принять',array("class"=>"btn btn-success"))}}
                                    {{Form::close()}}
                                    {{ Form::open(array('url' => '/deletejoin/'.$group->id, 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                                    {{Form::hidden('user_id',$member->user_id)}}
                                    {{Form::submit('Пшел отседа',array("class"=>"btn btn-danger"))}}
                                    {{Form::close()}}
                                </div><br/><br/>
                            @endforeach
                        </div>
                        <br/></div>
                </div>

            </div>
        @else
            <h3>Пользователи</h3>
            <div class="grop_members">
                @foreach($members as $member)
                    <div>
                        <img class="image left" width=60
                             src="{{ asset('uploads/'.User::find($member->user_id)->file)}}"> <a
                                href="{{route('show_user',User::find($member->user_id)->id)}}">
                            <p>{{User::find($member->user_id)->name}}</p></a>
                        @if(($group->admin_id == Auth::user()->id || $member->user_id == Auth::user()->id) && $group->admin_id != $member->user_id)
                            {{ Form::open(array('url' => '/deletejoin/'.$group->id, 'method' => 'delete', 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
                            {{Form::hidden('user_id',$member->user_id)}}
                            {{Form::submit('Пшел отседа',array("class"=>"btn btn-danger"))}}
                            {{Form::close()}}
                        @endif
                    </div><br/><br/>
                @endforeach
            </div><br/>
        @endif

        <h3>Администраторы</h3>
        <div>
            <img class="image left" width=60
                 src="{{asset('uploads/'.User::find($group->admin_id)->file)}}"> <a
                    href="{{route('show_user',User::find($group->admin_id)->id)}}">
                <p>{{User::find($group->admin_id)->name}}</p></a>
        </div><br/> <br/>

        <h3>Форум</h3>

        @foreach($posts as $post)
            <img width=60
                 src="{{asset('uploads/'.User::find($post->author_id)->file)}}">
            <p>{{User::find($post->author_id)->name}}</p>
            <p>{{$post->message}}</p>

        @endforeach
        {{$posts->links()}}
        {{ Form::open(array('url' => route('add_post', $group->id), 'role' => 'form', 'class' => 'form-horizontal', 'files' => true )) }}
        {{Form::textarea('message','', array("placeholder" => "Написать"))}}
        {{Form::submit('Отправить',array("class"=>"btn btn-success"))}}
        {{Form::close()}}
    @else
        @if (Session::has('alert'))
            <div class="alert alert-success">
                <p>{{ Session::get('alert') }}
            </div>
        @endif
        <a href="{{route("get_join", $group->id)}}" class="btn btn-lg btn-default">Подать заявку в
            группу</a>
    @endif

@stop