<?php

class AlertController extends BaseController
{
    public function sendAlert()
    {
        $street = str_replace(' ','+',trim($this->user_data->street));
        $getcoords = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . Auth::user()->house . "+" . $street . ",+" . Auth::user()->city . ",+Россия&sensor=false"));
        $lat = $getcoords->results[0]->geometry->location->lat;
        $lng = $getcoords->results[0]->geometry->location->lng;
        $url = "https://www.google.ru/maps?q=" . $lat . "," . $lng;
        $friends = Friends::where('confirm', '=', 1)->where('user_id', '=', Auth::user()->id)->get();
        $user = array();
        foreach ($friends as $friend)
            $user[] = User::find($friend->friend_id);
        foreach ($user as $u) {
            $sendsms = file_get_contents("http://sms.ru/sms/send?api_id=bdf695d1-957a-81c4-d5ac-06551718496e&to=" . $u->phone . "&text=" . urlencode(iconv("windows-1251", "utf-8", "Your friend is in trouble " . $url)));
            $msg = new Message();
            $msg->from = $this->user_data->id;
            $msg->to = $u->id;
            $msg->message = 'ТРЕВОГА! ' . Input::get('msg');
            $msg->save();
        }
        $alert = new Alert();
        $alert->author_id = $this->user_data->id;
        $alert->msg = $this->input['msg'];
        $alert->lat = $lat;
        $alert->lng = $lng;
        $alert->time = time();
        $alert->save();
        return Redirect::back()->withAlert('Разослано');
    }


    public function showAlerts()
    {
        if (empty($this->input['date']))
            $alerts = Alert::all();
        else
            $alerts = Alert::whereBetween('time', array(strtotime($this->input['date']), strtotime($this->input['date']) + 86400))->get();
        return View::make('alerts')->with('alerts', $alerts);
    }



}