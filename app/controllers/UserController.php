<?php

class UserController extends BaseController
{

    /**
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'UserController@showWelcome');
    |
    **/

    /** Логин **/
    
    
        /** Страница логина **/
    public function showLogin()
    {
        return View::make('login');
    }

        /** Отправка логина **/

    public
    function postLogin()
    {
        // Формируем базовый набор данных для авторизации
        // (isActive => 1 нужно для того, чтобы аторизоваться могли только
        // активированные пользователи)

        if (Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'isActive' => 1
        ))) {
            Log::info("User successfully logged in.");
            return Redirect::intended('/');
        } else {
            Log::info("User failed to login.");
        }

        $alert = "Неверная комбинация имени (email) и пароля, либо учетная запись еще не активирована.";

        // Возвращаем пользователя назад на форму входа с временной сессионной
        // переменной alert (withAlert)
        return Redirect::back()->withAlert($alert);
    }


    /** Выходим **/


    public
    function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }


    /** Главная страница **/

    public function showMain()
    {
        return View::make('main');
    }


    /** Регистрация **/
        /** Форма регистрации **/

    public function showReg()
    {
        return View::make('register');
    }

        /** Отправляем форму регистрации**/

    public
    function postRegister()
    {
        // Проверка входных данных
        $rules = User::$validation;
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            // В случае провала, редиректим обратно с ошибками и самими введенными данными
            return Redirect::to('register')->withErrors($validation)->withInput();
        }
        // Сама регистрация с уже проверенными данными
        $user = new User();
        $user->fill(Input::all());
        $id = $user->register();

        return $this->getMessage("Регистрация почти завершена. Вам необходимо подтвердить e-mail, указанный при регистрации, перейдя по ссылке в письме.");
    }

        /** Активируем аккаунт **/

    public
    function getActivate()
    {
        // var_dump(Input::all()); exit();

        // Получаем указанного пользователя
        $user = User::find(Input::get('user_id'));
        if (!$user) {
            return $this->getMessage("Неверная ссылка на активацию аккаунта.");
        }

        // Пытаемся его активировать с указанным кодом
        if ($user->activate(Input::get('activation_code'))) {
            // В случае успеха авторизовываем его
            Auth::login($user);
            // И выводим сообщение об успехе
            return $this->getMessage("Аккаунт активирован", "http://localhost/vyr/public/");
        }

        // В противном случае сообщаем об ошибке
        return $this->getMessage("Неверная ссылка на активацию аккаунта, либо учетная запись уже активирована.");
    }

    /** Вспоминаем пароль **/
    public function getRemind($token)
    {
        return View::make('remind')->with('token', $token);
    }

    /** Моя страница **/

    public function showMyProfile()
    {
        $friend = Friends::where('confirm', '=', 0)->where('user_id', '=', $this->user_data ->id)->get();
        $newones = count($friend);
        $friend = Friends::where('confirm', '=', 1)->where('user_id', '=', $this->user_data ->id)->get()->take(4);
        $referance = Referance::where('user_id', '=', $this->user_data ->id)->paginate(3);
        $posref = Referance::where('user_id', '=', $this->user_data ->id)->where('status','=','Позитивная')->paginate(3);
        $negref = Referance::where('user_id', '=', $this->user_data ->id)->where('status','=','Негативная')->paginate(3);
        $neuref = Referance::where('user_id', '=', $this->user_data ->id)->where('status','=','Нейтральная')->paginate(3);
        $usergroup = Usergroup::where('user_id','=',$this->user_data->id)->where('confirmed','=',1)->get();
        $groups = array();
        foreach ($usergroup as $ug)
            $groups[] = Group::find($ug->group_id);
      //  var_dump($friend); exit();
        return View::make('mypage')->with(array('newones' => $newones, 'refer' => $referance, 'neg' => $negref, 'pos' => $posref, 'neu' => $neuref, 'friend' => $friend, 'groups' => $groups));
    }

    /** Страница редактирования информации **/

    public function showEditProfile()
    {
        return View::make('edit_profile');
    }

    /** Отправка отредактированой информации **/

    public
    function postEditProfile($id)
    {
        $user = User::find($id);
        // 
        //	var_dump($this->input ['file']->getClientOriginalName());
        //	exit();
        $destination = public_path('uploads');
        $rules = array(
            'password' => 'confirmed|min:6|max:20',
            'name' => 'required|min:10',
            'phone' => 'required|min:10|numeric',
            'add_phone' => 'min:10|numeric',
            'status' => 'required',
            'file' => 'image',
            'city' => 'required | min: 2',
            'house' => 'required',
            'street' => 'required',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            // В случае провала, редиректим обратно с ошибками и самими введенными данными
            return Redirect::back()->withErrors($validation)->withInput();
        }
         
        if (isset($this->input ['name'])) {
            $user->name = $this->input ['name'];
        }
        if (isset($this->input ['city'])) {
            $user->city = $this->input ['city'];
        }
        if (isset($this->input ['street'])) {
            $user->street = $this->input ['street'];
        }
        if (isset($this->input ['house'])) {
            $user->house= $this->input ['house'];
        }
        if (isset($this->input ['file'])) {
            $user->file = Input::file('file')->getFilename() . '.' . Input::file('file')->guessClientExtension();
            $this->input ['file']->move($destination, Input::file('file')->getFilename() . '.' . Input::file('file')->guessClientExtension());
        }
        if (isset($this->input ['phone'])) {
            $user->phone = $this->input ['phone'];
        }
        if (isset($this->input ['add_phone'])) {
            $user->add_phone = $this->input ['add_phone'];
        }
        if (isset($this->input ['status'])) {
            $user->status = $this->input ['status'];
        }
        if (isset($this->input ['password'])) {
            $user->password = Hash::make($this->input ['password']);
        }
        $user->save();
        return Redirect::back()->withAlert('Информация успешно обновлена');
    }

    /** Друзья **/

        /** Показываем друзей **/


    public function showFriends()
    {
        $new_friend = Friends::where('confirm', '=', 0)->where('user_id', '=', $this->user_data ->id)->get();
        $friends = Friends::where('confirm', '=', 1)->where('user_id', '=', $this->user_data ->id)->get();
        $new_user = array();
        $user = array();
        foreach ($new_friend as $nf)
            $new_user[] = User::find($nf->friend_id);
        foreach ($friends as $friend)
            $user[] = User::find($friend->friend_id);
        return View::make('friends')->with(array('friends' => $user, 'new_friends' => $new_user));
    }

        /** Добавляем в друзья **/

    public function addFriend($id)
    {
        $friend = new Friends();
        $friend->user_id = $this->user_data ->id;
        $friend->friend_id = $id;
        $friend->confirm = false;
        $friend->save();
        $friend = new Friends();
        $friend->friend_id = $this->user_data ->id;
        $friend->user_id = $id;
        $friend->confirm = false;
        $friend->save();
        return Redirect::back()->withAlert('Заявка отправлена');
    }
        /** Принимаем заявку в друзья **/

    public function updateFriend($id)
    {
        $friend = Friends::where('user_id', '=', $this->user_data ->id)->where('friend_id', '=', $id)->first();
        $friend->confirm = true;

        $friend->save();
        $friend = Friends::where('user_id', '=', $id)->where('friend_id', '=', $this->user_data ->id)->first();
        $friend->confirm = true;
        $friend->save();
        return Redirect::to('friends');
    }

        /** Отклоняем заявку или удаляем из друзей **/

    public function deleteFriend($id)
    {
        Friends::where('user_id', '=', $this->user_data ->id)->where('friend_id', '=', $id)->delete();
        Friends::where('user_id', '=', $id)->where('friend_id', '=', $this->user_data ->id)->delete();
        return Redirect::back()->withAlert('Пользователь удален из друзей');
    }

        /** Друзья на карте**/

    public function getGeo()
    {
        $coords = array();
        $users = Friends::where('user_id','=',$this->user_data ->id)->where('confirm','=',1)->get();
        foreach ($users as $user)
        {
        	
            $street = str_replace(' ','+',trim(User::find($user->friend_id)->street));
			//var_dump("http://maps.googleapis.com/maps/api/geocode/json?address=".User::find($user->friend_id)->house."+".$street.",+".$city.",+Россия&sensor=false"); exit();
            $getcoords = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".User::find($user->friend_id)->house."+".$street.",+".User::find($user->friend_id)->city.",+Россия&sensor=false"));
			

		
            $lat = $getcoords->results[0]->geometry->location->lat;
            $lng =  $getcoords->results[0]->geometry->location->lng;
            $coords[] = (array('lat' => $lat, 'lng' => $lng, 'name' => User::find($user->friend_id)->name));
            
        }
        return View::make('geolocation')->with('coords', $coords);
    }


        /** Показываем страницу пользователя **/


    public function showProfile($id)
    {
        if ($id == $this->user_data ->id)
            return Redirect::to('mypage');
        $user = User::find($id);
        $referance = Referance::where('user_id', '=', $id)->get();
        $friend = Friends::whereRaw('user_id = ' . $id . ' and friend_id = ' . $this->user_data ->id)->first();
        if ($friend) {

            if ($friend->confirm)
                $alert = "Вы дружите";
            else
                $alert = "Заявка отправлена";
            return View::make('show_profile')->with(array('user' => $user, 'alert' => $alert, 'refer' => $referance));
        }
        return View::make('show_profile')->with(array('user' => $user, 'refer' => $referance));
    }


        /** Говорим, что спасли его (раз в сутки) **/

    public function isaveFriend($id)
    {

        if (null !== (Voting::where('saver_id', '=', $this->user_data ->id)->where('saved_id', '=', $id)->first())) {
            $vote = Voting::where('saver_id', '=', $this->user_data ->id)->where('saved_id', '=', $id)->first();
            if ($vote->when > time()) {
                $t = $vote->when - time();
                return Redirect::back()->withAlert('Вы его спасли, мы УЖЕ это учли, вы сможете сказать об этом еще раз через ' . $t . ' секунд');
            } else {
                $vote->delete();
            }
        }

        $user = User::find($id);
        $user->being_saved += 1;
        $user->save();
        $user = User::find($this->user_data ->id);
        $user->save += 1;
        $user->save();
        $vote = new Voting();
        $vote->saver_id = $this->user_data ->id;
        $vote->saved_id = $id;
        $vote->when = time() + 86400;
        $vote->save();
        return Redirect::back()->withAlert('Вы его спасли, мы это учли');

    }


        /** Говорим, что он(а) меня спас(ла) (раз в сутки) **/

    public
    function hesaveFriend($id)
    {

        if (null !== (Voting::where('saved_id', '=', $this->user_data ->id)->where('saver_id', '=', $id)->first())) {
            $vote = Voting::where('saved_id', '=', $this->user_data ->id)->where('saver_id', '=', $id)->first();
            if ($vote->when > time()) {
                $t = $vote->when - time();
                return Redirect::back()->withAlert('Он вас спас, мы УЖЕ это учли, вы сможете отблагодарить его еще раз через ' . $t . ' секунд');
            } else {
                $vote->delete();
            }
        }

        $user = User::find($id);
        $user->save += 1;
        $user->save();
        $user = User::find($this->user_data ->id);
        $user->being_saved += 1;
        $user->save();
        $vote = new Voting();
        $vote->saved_id = $this->user_data ->id;
        $vote->saver_id = $id;
        $vote->when = time() + 86400;
        $vote->save();
        return Redirect::back()->withAlert('Он вас спас, мы это учли');
    }


    /** Отзывы **/

        /** Страница создания отзыва **/

    public function getAddReferance($id)
    {
        if ($id == $this->user_data ->id)
            return Redirect::to('mypage');
        $user = User::find($id);
        return View::make('add_referance')->with('user', $user);
    }

        /** Отправляем отзыв **/
    public function postAddReferance($id)
    {

        $rules = Referance::$validation;
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            // В случае провала, редиректим обратно с ошибками и самими введенными данными
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $referance = new Referance();
        $referance->author_id = $this->user_data ->id;
        $referance->user_id = $id;
        $referance->referance = Input::get('referance');
        $referance->status = Input::get('status');
        $referance->save();
        return Redirect::back()->withAlert('Отзыв оставлен');
    }


        /** Удаляем отзыв **/
    public function deleteReferance($id)
    {
        Referance::where('id', '=', $id)->delete();
        return Redirect::back()->withAlert('Отзыв удален');
    }



    /** Сообщения **/
        /** Показываем страницу моих сообщений **/

    public function myInbox()
    {
        $fr = Friends::where('user_id', '=', $this->user_data ->id)->get();
        //$msg = array();
        foreach ($fr as $f) {
            $msg[] = Message::whereRaw('(`from` = ? and `to` = ?) or (`from` = ? and `to` = ?)', array($this->user_data->id, $f->friend_id, $f->friend_id, $this->user_data->id))->orderBy('created_at', 'desc')->first();

        }

        return View::make('myinbox')->with('message', $msg);
    }

        /** Показываем форму отправки сообщения с выбором пользователя **/

    public function showNewMessagesUnknown()
    {

        $friends = Friends::where('user_id', '=', $this->user_data ->id)->where('confirm', '=', 1)->get();
        return View::make('new_message_anyone')->with('friends', $friends);
    }

        /** Показываем форму отправки сообщения с выбраным пользователем **/

    public function showNewMessages($id)
    {
        if ($id == $this->user_data->id) {
            return Redirect::to('friends')->withAlert('Вы шизофреник');
        }
        $friend = Friends::where('user_id', '=', $this->user_data->id)->where('friend_id', '=', $id)->where('confirm', '=', 1)->first();
        if (!$friend) {
            return Redirect::to('friends')->withAlert('Пользователь не ваш друг');
        }

        $user = User::find($id);
        return View::make('new_message')->with('user', $user);
    }


        /** Отправляем сообщение **/

    public function sendMessage()
    {
        $rules = Message::$validation;
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            // В случае провала, редиректим обратно с ошибками и самими введенными данными
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $msg = new Message();
        $msg->from = $this->user_data ->id;
        $msg->to = Input::get('to');
        $msg->message = Input::get('message');
        $alert = "Message sent";
        $msg->save();
        return Redirect::back()->withAlert($alert);
    }

        /** Показываем переписку с конкретным пользователем **/

    public function showMessagesWith($id)
    {
        $message = Message::whereRaw('(`from` = ? and `to` = ?) or (`from` = ? and `to` = ?)', array($this->user_data->id, $id, $id, $this->user_data->id))->orderBy('created_at', 'desc')->paginate(3);
        return View::make('messages')->with(array('message' => $message, 'id' => $id));
    }


    /** Поиск **/
    
        /** Ajax поиск **/

    public function makeSearch() {
        $keywords = Input::get('keywords');
        $users = User::all();
        $groups = Group::all();
        $userres = array();
        $grres = array();
        $i = 0;
        foreach ($users as $user)
        {
            if (Str::contains(Str::lower($user->name), Str::lower($keywords)))
            {
                $userres[] = $user;
                $i++;
                if (5==$i)
                    break;
            }

        }
        $i=0;
        foreach ($groups as $group)
        {
            if (Str::contains(Str::lower($group->name), Str::lower($keywords)))
            {
                $grres[] = $group;
                $i++;
                if (5==$i)
                    break;
            }
        }
        return View::make('markup')->with(array('groups' => $grres, 'users' => $userres));
    }

        /** Страница поиска **/
    
    public function makeMakroSearch() {
        $keywords = Input::get('keywords');
        $users = User::all();
        $groups = Group::all();
        $userres = array();
        $grres = array();
        $i = 0;
        foreach ($users as $user)
        {
            if (Str::contains(Str::lower($user->name), Str::lower($keywords)))
            {
                $userres[] = $user;
                $i++;
                if (5==$i)
                    break;
            }

        }
        $i=0;
        foreach ($groups as $group)
        {
            if (Str::contains(Str::lower($group->name), Str::lower($keywords)))
            {
                $grres[] = $group;
                $i++;
                if (5==$i)
                    break;
            }
        }

        return View::make('search')->with(array('groups' => $grres, 'users' => $userres));
    }
}
