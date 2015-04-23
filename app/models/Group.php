
<?php



class Group extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group';
    public static $validation = array(
        'name' => 'required|min:5',
        'description' => 'required|min:50',
        'file' => 'image',
    );


}