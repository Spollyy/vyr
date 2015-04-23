<?php
/**
 * Created by PhpStorm.
 * User: ilya
 * Date: 06.03.15
 * Time: 12:26
 */

class Posts extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum';

    public static $validation = array(
        'message' => 'required'
    );

}