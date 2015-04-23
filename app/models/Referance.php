<?php

class Referance extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'referance';
    protected $fillable = array('referance', 'status');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public static $validation = array(
        'referance' => 'min:100',
    );


}