<?php
/**
 * Created by PhpStorm.
 * User: ilya
 * Date: 03.03.15
 * Time: 10:32
 */
/******************
 *  ВСЕ РЕФАКТОРИТЬ К ЕБЕНЯМ :)
 */
class GroupsController extends BaseController
{

    //Получаем Список групп


    public function getGroups() {
        $usergroup = Usergroup::where('user_id','=',$this->user_data->id)->where('confirmed','=',1)->get();
        $groups = array();
        foreach ($usergroup as $ug) {
            $groups[] = Group::find($ug->group_id);
        }
       return View::make('groups')->with('groups',$groups);
    }

    //Страница создания групп


    public function getCreateGroup() {
       return View::make('create_group');
    }


    //Создание группы


    public function postCreateGroup() {
        $destination = public_path('uploads');
         
        $rules = Group::$validation;
        $validation = Validator::make($this->input, $rules);
        if ($validation->fails()) {
            // В случае провала, редиректим обратно с ошибками и самими введенными данными
            return Redirect::back()->withErrors($validation)->withInput();
        }
        $group = new Group();
        $group->name = $this->input['name'];
        $group->description = $this->input['description'];
        $group->admin_id = $this->user_data->id;
        if (isset($this->input['file'])) {
            $group->file = Input::file('file')->getFilename() . '.' . Input::file('file')->guessClientExtension();
            $this->input['file']->move($destination, Input::file('file')->getFilename() . '.' . Input::file('file')->guessClientExtension());
        }
        $group->save();
        $usergroup = new Usergroup();
        $usergroup->group_id = Group::where('name','=',$this->input['name'])->first()->id;
        $usergroup->user_id = $this->user_data->id;
        $usergroup->confirmed = 1;
        $usergroup->save();
        return Redirect::back()->withAlert('Группа создана');
    }


    //Страница редактирования группы
    public function showEditGroup($id)
    {
        return View::make('edit_group')->with('id', $id);
    }

    //Редактирование группы

    public function postEditGroup($id)
    {
        $destination = public_path('uploads');
         
        $group = Group::find($id);
        $rules = Group::$validation;
        $validation = Validator::make($this->input, $rules);
        if ($validation->fails()) {
            // В случае провала, редиректим обратно с ошибками и самими введенными данными
            return Redirect::back()->withErrors($validation)->withInput();
        }
        $group->name = $this->input['name'];
        $group->description = $this->input['description'];
        if (isset($this->input['file'])) {
            $group->file = Input::file('file')->getFilename() . '.' . Input::file('file')->guessClientExtension();
            $this->input['file']->move($destination, Input::file('file')->getFilename() . '.' . Input::file('file')->guessClientExtension());
        }
        $group->save();
        return Redirect::back()->withAlert('Готово');
    }


    //Отображаем конкретную группу

    public function getGroup($id){
        $members = Usergroup::where('group_id','=',$id)->where('confirmed','=',true)->get();
        $new_members = Usergroup::where('group_id','=',$id)->where('confirmed','=',false)->get();
        $group = Group::find($id);
        $post = Posts::where('group_id','=',$id)->orderBy('created_at', 'desc')->paginate(10);
        return View::make('group')->with(array('group' => $group, 'members' => $members, 'new_members' => $new_members, 'posts' => $post));
    }


    //Втсупаем в группу
    public function joinGroup($id) {
        if (Usergroup::where('group_id','=', $id)->where('user_id','=', $this->user_data->id)->where('confirmed','=',0)->first())
            return Redirect::back()->withAlert('Вы уже отправляли заявку');
        $join = new Usergroup();
        $join->group_id = $id;
        $join->user_id = $this->user_data->id;
        $join->confirmed = 0;
        $join->save();
        return Redirect::back()->withAlert('Заявка подана');
    }


    //Принимаем заявку
    public function updateJoin($id) {
         
        $up = Usergroup::where('group_id','=', $id)->where('user_id','=', $this->input['user_id'])->where('confirmed','=',0)->first();
        $up->confirmed = 1;
        $up->save();
        return Redirect::back()->withAlert('Заявка одобрена');
    }


    //Отклоняем заявку или удаляем пользователя из группы
    public function deleteJoin($id) {
         
        Usergroup::where('group_id','=', $id)->where('user_id','=', $this->input['user_id'])->first()->delete();
        return Redirect::back()->withAlert('Пользователь или его заявка - удален');
    }



    //Пишем пост на стену


    public function addPost ($id) {
         
        $rules = Posts::$validation;
        $validation = Validator::make($this->input, $rules);
        if ($validation->fails()) {
            // В случае провала, редиректим обратно с ошибками и самими введенными данными
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $post = new Posts();
        $post->message = $this->input['message'];
        $post->group_id = $id;
        $post->author_id = $this->user_data->id;
        $post->save();
        return Redirect::back();
    }


    //Удаляем пост

    public function deletePost ($id) {
        Posts::find($id)->delete();
        return Redirect::back()->withAlert('Сообщение удалено');;
    }

}
