<?php
/**
 * Created by PhpStorm.
 * User: ilya
 * Date: 03.03.15
 * Time: 10:32
 */

class SeoController extends BaseController {

    public function postSeo()
    {

        $rules = Seo::$validation;

        $validation = Validator::make($this->input, $rules);
        if ($validation->fails()) {
            return Response::json(['success'=>false, 'errors'=>$validation->errors()->toArray()]);
        }

        $seo = new Seo();
        $seo->title = $this->input['title'];
        $seo->description = $this->input['description'];
        $seo->keywords = $this->input['keywords'];
        $seo->url = $this->input['url'];
        $seo->save();
        return Response::json(['success' => true]);
    }



    public function putSeo()
    {
        $seo = Seo::where('url','=',$this->input['url'])->first();
        $rules = Seo::$validation;

        $validation = Validator::make($this->input, $rules);
        if ($validation->fails()) {
            return Response::json(['success'=>false, 'errors'=>$validation->errors()->toArray()]);
        }
        $seo->title = $this->input['title'];
        $seo->description = $this->input['description'];
        $seo->keywords = $this->input['keywords'];
        $seo->url = $this->input['url'];
        $seo->save();
        return Response::json(['success' => true]);
    }
}