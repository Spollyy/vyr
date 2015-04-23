<html>
<head>
    {{ HTML::style('extensions/css/bootstrap.min.css'); }}
    {{ HTML::style('extensions/css/style.css'); }}
    {{ HTML::script('extensions/js/jquery-2.1.3.min.js'); }}
    {{ HTML::script('extensions/js/bootstrap.min.js'); }}
    {{ HTML::script('extensions/js/scripts.js'); }}
    @yield('additional')
    <?php

    if ($seo = Seo::where('url', '=', "viruchatel.u42697.netangels.ru/" . $_SERVER['REQUEST_URI'])->first()) {
        echo '<title>' . $seo->title . '</title>';
        echo '<meta name="keywords" content="' . $seo->keywords . '" />';
        echo '<meta name="description" content="' . $seo->description . '" />';
    }
    if (strpos($_SERVER['REQUEST_URI'], 'mypage'))
        echo '<title>Выручатель - ' . Auth::user()->name . '</title>';
    if (strpos($_SERVER['REQUEST_URI'], 'show'))
        echo '<title>Выручатель - ' . $user->name . '</title>';
    if (strpos($_SERVER['REQUEST_URI'], 'friends'))
        echo '<title>Друзья. Выручатель - ' . Auth::user()->name . '</title>';
    ?>

</head>
<body>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset('extensions/images/V.png')}}" width=50% style="margin-top: -10px;">
            </a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul class="nav navbar-nav" style="float:left;">
            @yield('header')
        </ul>
        @if(Auth::check())

            <ul class="nav navbar-nav navbar-right">
                <li>{{ Form::open(array('url' => '/widesearch', 'role' => 'form', 'class' => 'form-horizontal')) }}
                    <input type="text" class="form-control" id="search_input" name="keywords"
                           placeholder="Поиск по сайту"
                           onkeydown="down()" onkeyup="up()"
                           onkeypress="var keycode = (event.keyCode ? event.keyCode : event.which); if(keycode == 13){this.submit()}">
                </li>
                {{Form::close()}}
                <li id="search_result">

                </li>
                <li><a href="{{route('logout')}}">Выйти({{ Auth::user()->login }})</a></li>
            </ul>
        @endif
    </div>
    <!-- /.container-fluid -->
</nav>
<?php
if (Auth::check()) {
    if (Auth::user()->is_seo) {

        echo '<button type="button" class="btn btn-primary btn-sm" style="float: right" data-toggle="modal" data-target="#myModal" style="position: fixed;">SEO</button>';
        $flag = 0;
    } else
        $flag = 1;
} else
    $flag = 1;
?>
@yield('content')
@if(1 != $flag)
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="main_form">
                <?php
                if (!empty($seo))
                    echo <<<END
                <form role="form" action="#" id="seoup" method="post">
                    <h2>Изменить Сео</h2>

                        <div class="alert alert-info info">
                            <ul>
                            </ul></div>

                        <div class="alert alert-danger danger">
                            <ul>
                            </ul>
                        </div>
                    <input type="text" class="form-control" placeholder="Title" name="title" id="title" value="$seo->title" />
                    <input type="text" class="form-control" placeholder="Description" name="description" value="$seo->description" id="description"
                           />
                    <input type="text" class="form-control" placeholder="Ключевые слова" name="keywords" value="$seo->keywords" id="keywords"
                           />
                    <button class="btn btn-lg btn-info btn-block" type="submit">Изменить</button>
                </form>
END;
                else
                    echo <<<END
                <form role="form" action="#" id="seo" method="post">
                    <h2>Прикрепить Сео</h2>

                        <div class="alert alert-info info">
                            <ul>
                            </ul></div>

                        <div class="alert alert-danger danger">
                            <ul>
                            </ul>
                        </div>
                    <input type="text" class="form-control" placeholder="Title" name="title" id="title" />
                    <input type="text" class="form-control" placeholder="Description" name="description" id="description"
                           />
                    <input type="text" class="form-control" placeholder="Ключевые слова" name="keywords" id="keywords"
                           />
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Прикрепить</button>
                </form>
END;
                ?>
            </div>
        </div>
    </div>
    <script>
        $("document").ready(function () {
            var info = $('.info');
            var dang = $('.danger');
            info.hide();
            dang.hide();
            $("#seo").submit(function (e) {
                e.preventDefault();

                var formData = new FormData();
                formData.append('url', document.URL.replace(/.*?:\/\//g, ""));
                formData.append('title', $('#title').val());
                formData.append('description', $('#description').val());
                formData.append('keywords', $('#keywords').val());
                $.ajax({
                    url: 'seo',
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    data: formData,
                    success: function (data) {
                        dang.hide().find('ul').empty();
                        info.hide().find('ul').empty();
                        if (!data.success) {
                            $.each(data.errors, function (index, error) {
                                dang.find('ul').append('<li>' + error + '</li>');
                            });
                            dang.slideDown();
                        }
                        else {
                            info.find('ul').append('<li>Seo добавлено</li>');
                            info.slideDown();
                        }
                    },
                    error: function () {
                    }

                });
            });
            $("#seoup").submit(function (e) {
                e.preventDefault();

                var formData = new FormData();
                formData.append('url', document.URL.replace(/.*?:\/\//g, ""));
                formData.append('title', $('#title').val());
                formData.append('description', $('#description').val());
                formData.append('keywords', $('#keywords').val());
                $.ajax({
                    url: 'seoUpdate',
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    data: formData,
                    success: function (data) {
                        dang.hide().find('ul').empty();
                        info.hide().find('ul').empty();
                        if (!data.success) {
                            $.each(data.errors, function (index, error) {
                                dang.find('ul').append('<li>' + error + '</li>');
                            });
                            dang.slideDown();
                        }
                        else {
                            info.find('ul').append('<li>Seo обновлено</li>');
                            info.slideDown();
                        }
                    },
                    error: function () {
                    }

                });


            });
        });
    </script>
@endif
</body>
</html>

