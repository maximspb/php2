<?php
namespace App\Models;

use App\Db;
use App\Model;
use App\View;

class Article extends Model
{
    /**
     * по умолчанию задано имя таблицы новостей в БД
     * @var string $table
     */
    protected static $table = 'news';
    /**
     * @var $id
     */

    public $id;
    /**
     * @var string $title
     */
    public $title;
    /**
     * @var string $text
     */
    public $text;
    /**
     * id автора
     * @var string $author_id
     */
    public $author_id;

    /**
     * получение последних n новостей из БД
     * @param int $num
     * @return array
     */
    public static function getLastRec(int $num)
    {
        $db = new Db();
        $sql = 'SELECT * from'.' '. static::$table .' '. 'ORDER BY id DESC '. 'LIMIT '. $num;
        return $db->query($sql);
    }

    /**
     * метод возвращает объект класса Author
     * @param $name
     * @return object
     */
    public function __get($name)
    {
        if (!empty($this->author_id)) {
             $db = new Db();
             $data =[':id'=>$this->author_id];
             $sql ='SELECT * FROM authors WHERE id =:id';
             $res = $db->query($sql, $data, Author::class);
             $result = $res[0];
             return $result;
        }
    }
}
