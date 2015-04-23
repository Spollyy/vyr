<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/******************
 *  ВСЕ РЕФАКТОРИТЬ К ЕБЕНЯМ :)
 */
/* Главная */

Route::get('/', array ('as' => 'home', 'uses' =>'UserController@showMain'));


/*Маршруты видимые только после логина, иначе - редирект на '/' */

Route::group(array('before' => 'auth'), function () {


    /* Тестовый */

    Route::get('/blank', 'UserController@showBlank');


    /* Пользовательские */
        /* Логаут */
    Route::get('/logout', array ('as' => 'logout', 'uses' =>'UserController@getLogout'));

        /* Редактируем профиль */
    Route::get('/edit/{id}', array ('as' => 'get_edit_profile', 'uses' =>'UserController@showEditProfile'));
    Route::put('/edit/{id}', array ('as' => 'put_edit_profile', 'uses' =>'UserController@postEditProfile'));

        /* Моя страница */
    Route::get('/mypage', array ('as' => 'mypage', 'uses' =>'UserController@showMyProfile'));

    /* Друзья */
        /* Показываем всех друзей */
    Route::get('/friends', array ('as' => 'show_friends', 'uses' =>'UserController@showFriends'));

        /* Добавляем друга (кидаем заявку) */
    Route::get('/addfriend/{id}', array ('as' => 'add_friend', 'uses' =>'UserController@addFriend'));
        /* Подтверждаем */
    Route::put('/updatefriend/{id}', array ('as' => 'update_friend', 'uses' =>'UserController@updateFriend'));
        /* Отклоняем заявку или удаляем из друзей */
    Route::delete('/deletefriend/{id}', array ('as' => 'delete_friend', 'uses' =>'UserController@deleteFriend'));

        /* Показываем страницу пользователя */
    Route::get('/show/{id}', array ('as' => 'show_user', 'uses' =>'UserController@showProfile'));



    /* Спасения и отзывы */
        /* Кнопка я его спас (раз в сутки) */
    Route::get('/isave/{id}', array ('as' => 'i_save', 'uses' =>'UserController@isaveFriend'));
        /* Кнопка он меня спас (раз в сутки) */
    Route::get('/hesave/{id}', array ('as' => 'he_save', 'uses' =>'UserController@hesaveFriend'));
        /* Добавляем отзыв */
    Route::get('/addref/{id}', array ('as' => 'get_add_referance', 'uses' =>'UserController@getAddReferance'));
    Route::post('/addref/{id}', array ('as' => 'post_add_referance', 'uses' =>'UserController@postAddReferance'));
        /* Удаляем отзыв */
    Route::delete('/deleteref/{id}', array ('as' => 'delete_referance', 'uses' =>'UserController@deleteReferance'));


    /* Переписка */
        /* Новое сообщение конкретному пользователю */
    Route::get('/new_message/{id}', array ('as' => 'new_message', 'uses' =>'UserController@showNewMessages'));
        /* Новое сообщение с выбором собеседника */
    Route::get('/new_message/', array ('as' => 'new_unknown_message', 'uses' =>'UserController@showNewMessagesUnknown'));
        /* Отправляем */
    Route::post('/sendmessage', array ('as' => 'send_message', 'uses' =>'UserController@sendMessage'));
        /* Список входящих */
    Route::get('/myinbox', array ('as' => 'inbox', 'uses' =>'UserController@myInbox'));
        /* Переписка с */
    Route::get('/messaging_with/{id}', array ('as' => 'mess_with', 'uses' =>'UserController@showMessagesWith'));

    /* Поиск */
        /* Углебленный */
    Route::post('/widesearch', array ('as' => 'widesearch', 'uses' =>'UserController@makeMakroSearch'));
        /* Который сверху, ajax */
    Route::post('search', array ('as' => 'search', 'uses' =>'UserController@makeSearch'));

    /* Тревога! Вызвать помощь (для СМС рассылки нужны деньги на счет, упс */
    Route::post('alert', array ('as' => 'get_alert', 'uses' =>'AlertController@sendAlert'));

    /* Админ видит все вызовы */

    Route::get('alerts', array ('as' => 'get_alerts', 'uses' =>'AlertController@showAlerts'));

    Route::post('alerts', array ('as' => 'get_alerts', 'uses' => 'AlertController@showAlerts'));

    /* Друзья на карте (google maps, центрирование - екб) */
    Route::get('geo', array ('as' => 'geo', 'uses' =>'UserController@getGeo'));




    /* Сео */ /* ВЫДЕЛИТЬ ТОЛЬКО ДЛЯ СЕО, потом */

    Route::post('/seoUpdate', array ('as' => 'seoupdate', 'uses' =>'SeoController@putSeo', 'before' => 'is_seo'));


    /* Группа */
        /* Создание */
    Route::get('/create_group', array ('as' => 'get_create_group', 'uses' =>'GroupsController@getCreateGroup'));
    Route::post('/create_group', array ('as' => 'post_create_group', 'uses' =>'GroupsController@postCreateGroup'));
    /* Редактирование */
    Route::get('/edit_group/{id}', array ('as' => 'get_edit_group', 'uses' => 'GroupsController@showEditGroup'));
    Route::put('/edit_group/{id}', array ('as' => 'post_edit_group', 'uses' =>'GroupsController@postEditGroup'));

        /* Список групп */
    Route::get('/groups', array ('as' => 'groups_list', 'uses' =>'GroupsController@getGroups'));

        /* Конкретнрая групппа */
    Route::get('/group/{id}', array ('as' => 'group', 'uses' =>'GroupsController@getGroup'));

        /* Вступаем в группу */
    Route::get('/join/{id}', array ('as' => 'get_join', 'uses' =>'GroupsController@joinGroup'));

        /* Принимаем заявку в группу */
    Route::post('join/{id}', array ('as' => 'post_join', 'uses' =>'GroupsController@updateJoin'));

        /* Удаляем из группы */
    Route::delete('deletejoin/{id}', array ('as' => 'delete_join', 'uses' =>'GroupsController@deleteJoin'));

        /* Добавляем запись на стену */
    Route::post('addPost/{id}', array ('as' => 'add_post', 'uses' =>'GroupsController@addPost'));


});

/* Маршруты видимые всем */

/* Гостевые и пользовательские инструменты */

    /* Активация */
    Route::get('/activate', array ('as' => 'get_activate', 'uses' =>'UserController@getActivate'));

    /*Регистрация*/
    Route::get('/register', array ('as' => 'get_register', 'uses' =>'UserController@showReg'));
    Route::post('/register', array ('as' => 'post_register', 'uses' =>'UserController@postRegister'));

    /*Восстановление*/
    Route::get('/remind', array ('as' => 'get_remind', 'uses' =>'RemindersController@getRemind'));
    Route::post('/remind/{token}', array ('as' => 'post_remind', 'uses' =>'RemindersController@postRemind'));

    /*Восстановление, смена пароля*/
    Route::get('/password/remind/{token}', array ('as' => 'get_pwd_reset', 'uses' =>'RemindersController@getReset'));
    Route::post('/password/remind/{token}', array ('as' => 'post_pwd_reset', 'uses' =>'RemindersController@postReset'));

    /*Вход*/
    Route::post('/login', array ('as' => 'post_login', 'uses' =>'UserController@postLogin'));
    Route::get('/login', array ('as' => 'get_login', 'uses' =>'UserController@showLogin'));