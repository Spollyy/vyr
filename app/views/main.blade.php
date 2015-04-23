<!doctype html>
<html lang="ru">
<head>
    <title>Выручатель</title>
    {{ HTML::style('extensions/css/reset.css'); }}
    {{ HTML::style('extensions/css/style.css'); }}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    {{ HTML::script('extensions/js/jquery-2.1.3.min.js'); }}
    {{HTML::script('extensions/js/scripts.js')}}
    {{HTML::script('extensions/js/script.js')}}
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
                <img src="{{asset('extensions/images/del/banner.jpg')}}" alt="banner" />
            </div>
        </div>
        <div class="header-wrap">
            <div class="header">
                <div class="logo">
                    <a href=""><img src="{{asset('extensions/images/logo.png')}}" alt="logo" /></a>
                </div>
                <nav>
                    <ul class="main">
                        <li><a href="{{route('mypage')}}">Моя страница</a></li>
                        <li><a href="{{route('geo')}}">Карта</a></li>
                        <li><a href="">Топ</a></li>
                        <li><a href="">Магазин</a></li>
                        <li><a href="">Выход</a></li>
                    </ul>
                </nav>
                <div class="search">
                    <img src="{{asset('extensions/images/search.png')}}" alt="" />
                    <div class="search-wrap">
                        <input type="text" name="Search" placeholder='Поиск' /><i></i>
                    </div>
                </div>
                <div class="sos"></div>
            </div>
        </div>
    </header>
    <div class="clear"></div>
    <div class="content">
        <div class="main p1">
            <div class="help">
                <div class="who-help">
                    <i></i>
                    <div class="title">Кому помочь?</div>
                    <p>Этим людям</p>
                    <p>нужна помощь</p>
                </div>
                <div class="user-need-help js-complain">
                    <div class="complain">Пожаловаться</div>
                    <img class='user-pic' src="{{asset('extensions/images/del/pic4.png')}}" alt="" />
                    <div class="show-to-map">
                        <i></i>
                        <p>Показать на карте</p>
                    </div>
                    <div class="b-problem">
                        <div class="name">
                            <a href="" class='metka' target="_blank"></a>Анна Ульянова <span>(гость)</span>
                        </div>
                    </div>
                    <div class="devider"></div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="user-need-help js-complain">
                    <div class="complain">Пожаловаться</div>
                    <img class='user-pic' src="{{asset('extensions/images/del/pic5.png')}}" alt="" />
                    <div class="show-to-map">
                        <i></i>
                        <p>Показать на карте</p>
                    </div>
                    <div class="b-problem">
                        <div class="name">
                            <a href="" class='metka' target="_blank"></a>Андрей Рябков
                        </div>
                        <p><span class='js-open-desc'>Сломалась машина</span></p>
                    </div>
                    <div class="devider"></div>
                    <div class="clear"></div>
                </div>

                <div class="user-need-help js-complain">
                    <div class="complain">Пожаловаться</div>
                    <img class='user-pic' src="{{asset('extensions/images/del/pic6.png')}}" alt="" />
                    <div class="show-to-map">
                        <i></i>
                        <p>Показать на карте</p>
                    </div>
                    <div class="b-problem">
                        <div class="name">
                            <a href="" class='metka' target="_blank"></a>Леопольд Семенов
                        </div>
                        <p><span class='js-open-desc dashed'>Нужны резиновые сапоги<i></i></span></p>
                        <div class="desc">
                            <b></b>
                            Друзья, еду на картошку, продырявил сапоги, кто-нибудь может одолжить до понедельника?
                            Обещаю вернуть, либо возместить деньгами! <br>Южный Автовокзал, спасайте!
                        </div>
                    </div>
                    <div class="devider"></div>
                    <div class="clear"></div>
                </div>

                <div class="user-need-help js-complain">
                    <div class="complain">Пожаловаться</div>
                    <img class='user-pic' src="{{asset('extensions/images/no-photo_girl.png')}}" alt="" />
                    <div class="show-to-map">
                        <i></i>
                        <p>Показать на карте</p>
                    </div>
                    <div class="b-problem">
                        <div class="name">
                            <a href="" class='metka' target="_blank"></a>Елена Стукачева
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="tops">
                <div class="tops-upper">
                    <img class='icon' src="{{asset('extensions/images/top.png')}}" alt="top" />
                    <div class="title"><h2>Топ месяца</h2></div>
                    <div class="city">Екатеринбург</div>
                </div>
                <div class="users">
                    <img class='user-pic' src="{{asset('extensions/images/del/pic1.png')}}" alt="user" />
                    <div class="name">Сергей Высоков</div>
                    <div class="desc">Спас 3 человек, получил 2 отзыва</div>
                    <div class="stars">41</div>
                    <a class='more' href="">Подробнее</a>
                </div>
                <div class="users">
                    <img class='user-pic' src="{{asset('extensions/images/del/pic2.png')}}" alt="user" />
                    <div class="name">Зина Королёва</div>
                    <div class="desc">Спасла 1 человека, получила 1 отзыв</div>
                    <div class="stars">5</div>
                    <a class='more' href="">Подробнее</a>
                </div>
            </div>

            <div class="reviews">
                <div class="tops-upper">
                    <img class='icon' src="{{asset('extensions/images/review.png')}}" alt="top" />
                    <div class="title"><h2>Последние отзывы</h2></div>
                </div>
                <div class="users arrow">
                    <img class='user-pic' src="{{asset('extensions/images/del/pic3.png')}}" alt="user" />
                    <div class="name">Антонина Петрова</div>
                    <div class="desc">Ею спасен:</div>
                </div>
                <div class="users js-complain">
                    <img class='user-pic' src="{{asset('extensions/images/no-photo_boy.png')}}" alt="user" />
                    <div class="show-to-map v2">
                        <i></i>
                        <p>Показать на карте</p>
                    </div>
                    <div class="name need-help"><a href="#" class='metka' target="_blank"></a>Константин Иванов</div>
                    <div class="comment">Кто бы знал, что некоторые женщины разбираются в машинах лучше,
                        чем мужики! Спасибо Тоне за то, что в нужный момент помогла мне. Человек с большой буквы!!!</div>
                </div>
            </div>

            <footer class='m1'>
                <div class="footer">
                    <div class="share">
                        <button class="js-open-share-popup" type="submit"><img src="{{asset('extensions/images/share_img.png')}}" alt="">ПОделиться</button>
                        <div class="share-wrap"></div>
                        <div class="share_icons">
                            <div class="addthis_sharing_toolbox" data-url="http://test2.happymexanik.ru/OFF/" data-title="Выручатель.ру - Социальная Служба Спасения"><div id="atstbx" class="at-share-tbx-element addthis_32x32_style addthis-smartlayers addthis-animated at4-show"><a class="at-share-btn at-svc-facebook"><span class="at4-icon aticon-facebook" title="Facebook"></span></a><a class="at-share-btn at-svc-vk"><span class="at4-icon aticon-vk" title="VKontakte"></span></a><a class="at-share-btn at-svc-twitter"><span class="at4-icon aticon-twitter" title="Twitter"></span></a><a class="at-share-btn at-svc-google_plusone_share"><span class="at4-icon aticon-google_plusone_share" title="Google+"></span></a><a class="at-share-btn at-svc-odnoklassniki_ru"><span class="at4-icon aticon-odnoklassniki_ru" title="Odnoklassniki"></span></a><a class="at-share-btn at-svc-linkedin"><span class="at4-icon aticon-linkedin" title="LinkedIn"></span></a></div></div>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-552240f40f7c40df" async="async"></script>
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
                    <div class="happy"><a href="http://www.happymexanik.ru" target="_blank"><img src="{{asset('extensions/images/happy.png')}}" alt=""></a></div>
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