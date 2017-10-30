<?php
namespace App;

use \PDO;

use App\Db;

abstract class Model
{
    protected static $table = null;
    public $id;

    public static function getAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM' . ' ' . static::$table;
        return $db->query($sql, [], static::class);
    }

    public static function findById($id)
    {
        $data =[':id'=>$id];
        $sql ='SELECT * FROM'.' '. static::$table.' '. 'WHERE id = :id';
        $db = new Db();
        $arr = $db->query($sql, $data, static::class);
        return $arr[0];
    }
}
