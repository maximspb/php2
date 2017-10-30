<?php
namespace App\Models;

use App\Db;
use App\Model;

class Article extends Model
{
    protected static $table = 'news';
    public $id;
    public $title;
    public $text;
    public static function getLastRec(int $num)
    {
        $db = new Db();
        $sql = 'SELECT * from'.' '. static::$table .' '. 'ORDER BY id DESC '. 'LIMIT '. $num;
        return $db->query($sql);
    }
}
