<?php
/**
 * Created by PhpStorm.
 * User: ilya
 * Date: 06.03.15
 * Time: 12:26
 */

class Friends extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'friends';

    public function users()
    {
        return $this->belongsToMany('User');
    }

}