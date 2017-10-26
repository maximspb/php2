<?php
namespace Models;

use PDO;

use Models\Db;

abstract class News
{
    protected static $table = null;
    public $id;
    //у метода getAll  необязательный аргумент $option для уточнения sql-запроса
    public static function getAll(string $option = null)
    {
        $db = new Db();
        $sql = 'SELECT * FROM' . ' ' . static::$table .' '. $option;
        return $db->query($sql, [], static::class);
    }
    public static function findById($id)
    {
        $data =[':id'=>$id];
        $sql ='SELECT * FROM'.' '. static::$table.' '. 'WHERE id = :id';
        $db = new Db();
        return $db->query($sql, $data, static::class);
    }
}
