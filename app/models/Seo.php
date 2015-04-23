<?php


class Seo extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seo';
    protected $fillable = array('title','keywords','description', 'url');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public static $validation = array (
        'title' => 'max:60',
        'description' => 'min:5',
        'keywords' => 'min:5',
    );


}
