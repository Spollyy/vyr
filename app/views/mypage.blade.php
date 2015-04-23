<!doctype html>
<html lang="ru">
<head>
    <title>Выручатель</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    {{ HTML::script('extensions/js/jquery-2.1.3.min.js'); }}
    {{HTML::script('extensions/js/scripts.js')}}
    {{HTML::script('extensions/js/script.js')}}
    {{ HTML::style('extensions/css/reset.css'); }}
    {{ HTML::style('extensions/css/style.css'); }}
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrap">
    <header>
        <div class="banner-wrap">
            <div class="banner">
                <img src="{{asset('extensions/images/del/banner.jpg')}}" alt="banner"/>
            </div>
        </div>
        <div class="header-wrap">
            <div class="header">
                <div class="logo">
                    <a href=""><img src="{{asset('extensions/images/logo.png')}}" alt="logo"/></a>
                </div>
                <nav>
                    <ul class="main">
                        <li><a href="">Моя страница</a></li>
                        <li><a href="">Карта</a></li>
                        <li><a href="">Топ</a></li>
                        <li><a href="">Магазин</a></li>
                        <li><a href="">Выход</a></li>
                    </ul>
                </nav>
                <div class="search">
                    <img src="{{asset('extensions/images/search.png')}}" alt=""/>

                    <div class="search-wrap">
                        <input type="text" name="Search" placeholder='Поиск'/><i></i>
                    </div>
                </div>
                <div class="sos"></div>
                <div class="message"></div>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="main">
            <div class="info">
                <div class="info_user">
                    <div class="info_pic">
                        <img src="{{asset('uploads/'.Auth::user()->file)}}" alt=""/>
                    </div>
                    <div class="name">{{Auth::user()->name}}</div>
                    <div class="city">{{Auth::user()->city}}</div>
                    <div class="status">{{Auth::user()->status}}</div>
                    <div class="stars">4.3</div>
                </div>
                <div class="statistics">
                    <div class="to-help">
                        <p>Спасла</p>

                        <div class="number">{{Auth::user()->save}}</div>
                        <p class='p-small'>человек</p>
                    </div>
                    <div class="to-help">
                        <p>Спасена</p>

                        <div class="number red">{{Auth::user()->being_saved}}</div>
                        <p class='p-small'>раз</p>
                    </div>
                </div>
                <div class="number_in_top">
                    <p>Номер в топе</p>

                    <p>15</p>
                    <img src="{{asset('extensions/images/top_grey.png')}}" alt=""/>
                </div>
                <button class="save_to_me">Меня спасли</button>
            </div>

            <div class="wrapper_info">
                <div class="navigation">
                    <nav>
                        <ul>
                            <li><a href="">Удалить из друзей</a></li>
                            <li><a href="">Отправить сообщение</a></li>
                            <li><a href="">Оставить отзыв</a></li>
                        </ul>
                    </nav>
                    <div class="complain_on_user">
                        <a href=""><p>Пожаловаться <br>на пользователя</p></a>
                    </div>
                    <div class="left_banner">
                        <img src="{{asset('extensions/images/del/banner2.jpg')}}" alt=""/>
                    </div>
                </div>

                <div class="height-info">
                    <div class="b-friends">
                        <div class="friends-title">Друзья <span>45</span></div>
                        @foreach($friend as $fr)
                            <div class="wrap-friens">
                                <div class="friend">
                                    <a href="">
                                        <img src="{{asset('uploads/'.User::find($fr->friend_id)->file)}}" alt="friend"/>

                                        <div class="name">{{User::find($fr->friend_id)->name}}</div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="devider_vertical"></div>
                    <div class="b-groups">
                        <div class="groups-title">Группы <span>3</span></div>

                        @foreach ($groups as $group)
                            <div class="wrap-groups">
                                <div class="groups">
                                    <a href="">
                                        <img src="{{asset('uploads/'.$group->file)}}" alt="group"/>

                                        <div class="name">{{$group->name}}</div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="b-reviews">
                        <div class="reviews-title">Отзывы <span>{{count($refer)}}</span></div>
                        <div class="tabs3">
                            <ul class="i-tab3">
                                <li><p>Все</p></li>
                                <li><p class='color green'>Положительные <span class='green'>({{count($pos)}})</span></p></li>
                                <li><p class='color orange'>Нейтральные <span class='orange'>({{count($neu)}})</span></p></li>
                                <li><p class='color red'>Отрицательные <span class='red'>({{count($neg)}})</span></p></li>
                            </ul>
                            <ul class="tab-content3">
                                <li>
                                    @foreach($refer as $rf)
                                        <div class="info-devider js-complain">
                                            <div class="complain">Пожаловаться</div>

                                            @if($rf->status == 'Нейтральная')
                                                <div class="info-reviews border-orange">
                                                    <img src="{{asset('uploads/'.User::find($rf->author_id)->file)}}" alt=""/>

                                                    <div class="name">{{User::find($rf->author_id)->name}}</div>
                                                    <div class="date">{{$rf->created_at}}</div>
                                                    <div class="clear"></div>
                                                    <div class="desc">
                                                        {{$rf->referance}}
                                                    </div>
                                                </div>
                                            @elseif($rf->status == 'Позитивная')
                                                <div class="info-reviews border-green">
                                                    <img src="{{asset('uploads/'.User::find($rf->author_id)->file)}}" alt=""/>

                                                    <div class="name">{{User::find($rf->author_id)->name}}</div>
                                                    <div class="date">{{$rf->created_at}}</div>
                                                    <div class="clear"></div>
                                                    <div class="desc">
                                                        {{$rf->referance}}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="info-reviews border-red">
                                                    <img src="{{asset('uploads/'.User::find($rf->author_id)->file)}}" alt=""/>

                                                    <div class="name">{{User::find($rf->author_id)->name}}</div>
                                                    <div class="date">{{$rf->created_at}}</div>
                                                    <div class="clear"></div>
                                                    <div class="desc">
                                                        {{$rf->referance}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </li>
                                <li>
                                    @foreach($pos as $rf)
                                    <div class="info-devider js-complain">
                                        <div class="complain">Пожаловаться</div>
                                        <div class="info-reviews border-green">
                                            <img src="{{asset('uploads/'.User::find($rf->author_id)->file)}}" alt=""/>

                                            <div class="name">{{User::find($rf->author_id)->name}}</div>
                                            <div class="date">{{$rf->created_at}}</div>
                                            <div class="clear"></div>
                                            <div class="desc">
                                                {{$rf->referance}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </li>
                                <li>
                                    @foreach($neu as $rf)
                                        <div class="info-devider js-complain">
                                            <div class="complain">Пожаловаться</div>
                                            <div class="info-reviews border-orange">
                                                <img src="{{asset('uploads/'.User::find($rf->author_id)->file)}}" alt=""/>

                                                <div class="name">{{User::find($rf->author_id)->name}}</div>
                                                <div class="date">{{$rf->created_at}}</div>
                                                <div class="clear"></div>
                                                <div class="desc">
                                                    {{$rf->referance}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </li>
                                <li>
                                    @foreach($neg as $rf)
                                        <div class="info-devider js-complain">
                                            <div class="complain">Пожаловаться</div>
                                            <div class="info-reviews border-red">
                                                <img src="{{asset('uploads/'.User::find($rf->author_id)->file)}}" alt=""/>

                                                <div class="name">{{User::find($rf->author_id)->name}}</div>
                                                <div class="date">{{$rf->created_at}}</div>
                                                <div class="clear"></div>
                                                <div class="desc">
                                                    {{$rf->referance}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </li>

                            </ul>

                            <div class="paginacia">
                                <a id="prev" href="">&laquo;</a>
                                <a class="active" href="">1</a><a href="">2</a><a href="">3</a>
                                <a id="next" href="">&raquo;</a>
                            </div>

                            <div class="your-reviews">
                                <textarea cols="30" rows="10" placeholder='Ваш отзыв...'></textarea>
                            </div>
                            <form action="form.php" method="POST" enctype="multipart/form-data">
                                <div class="mark js_mark_form">
                                    <b></b>

                                    <p>Оценка <span></span></p>
                                    <i class='js-chose-mark'>Выберите оценку</i>
                                    <ul class='hidden'>
                                        <li><p class='color green'>Положительная</p></li>
                                        <li><p class='color orange'>Нейтральная</p></li>
                                        <li><p class='color red'>Отрицательная</p></li>
                                    </ul>
                                    <div class="clear"></div>
                                    <button class='send_to_reviews'><img
                                                src="{{asset('extensions/images/arrow-send.png')}}" alt=""/>Отправить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>

            <footer>
                <div class="footer">
                    <div class="share">
                        <button class="js-open-share-popup" type="submit"><img
                                    src="{{asset('extensions/images/share_img.png')}}" alt="">ПОделиться
                        </button>
                        <div class="share-wrap"></div>
                        <div class="share_icons">
                            <div class="addthis_sharing_toolbox" data-url="http://test2.happymexanik.ru/OFF/"
                                 data-title="Выручатель.ру - Социальная Служба Спасения">
                                <div id="atstbx"
                                     class="at-share-tbx-element addthis_32x32_style addthis-smartlayers addthis-animated at4-show">
                                    <a class="at-share-btn at-svc-facebook"><span class="at4-icon aticon-facebook"
                                                                                  title="Facebook"></span></a><a
                                            class="at-share-btn at-svc-vk"><span class="at4-icon aticon-vk"
                                                                                 title="VKontakte"></span></a><a
                                            class="at-share-btn at-svc-twitter"><span class="at4-icon aticon-twitter"
                                                                                      title="Twitter"></span></a><a
                                            class="at-share-btn at-svc-google_plusone_share"><span
                                                class="at4-icon aticon-google_plusone_share" title="Google+"></span></a><a
                                            class="at-share-btn at-svc-odnoklassniki_ru"><span
                                                class="at4-icon aticon-odnoklassniki_ru"
                                                title="Odnoklassniki"></span></a><a
                                            class="at-share-btn at-svc-linkedin"><span class="at4-icon aticon-linkedin"
                                                                                       title="LinkedIn"></span></a>
                                </div>
                            </div>
                            <script type="text/javascript"
                                    src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-552240f40f7c40df"
                                    async="async"></script>
                        </div>
                    </div>

                    <div class="follow-to-us">
                        <p>Следите за нами:</p>

                        <div class="b-social">
                            <a class="fb" target="_blank" href="https://www.facebook.com/1628482280718403 "></a>
                            <a class="vk" target="_blank" href=" http://vk.com/vyruchatel "></a>
                            <a class="tw" target="_blank" href=" https://twitter.com/vyruchatel"></a>
                            <a class="gl" target="_blank" href=" https://plus.google.com/116722984093134916188"></a>
                            <a class="od" target="_blank" href="http://ok.ru/group/54559991726085 "></a>
                            <a class="in" target="_blank" href="https://instagram.com/vyruchatel/"></a>
                        </div>
                        <a class='tumb' href="http://vyruchatelru.tumblr.com/" target="_blank">наш блог</a>
                    </div>
                    <div class="copyright">
                        <p>© Выручатель.ру, 2015</p><br>

                        <p>Телефон: <a href="tel:+79122228605">+7(912) 222-86-05</a></p>

                        <p>E-mail: <a class="mail" href="mailto:vyruchatel@gmail.com">vyruchatel@gmail.com</a></p>
                    </div>
                    <div class="happy"><a href="http://www.happymexanik.ru" target="_blank"><img
                                    src="{{asset('extensions/images/happy.png')}}" alt=""></a></div>
                    <div class="moderator">
                        <a href="#">Написать модератору</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="bg-footer"></div>
</div>
</body>
</html>