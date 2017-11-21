<?php
namespace App\Models;

use App\Db;
use App\Model;
//use App\View;

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

            return Author::findById($this->author_id);

    }
    public function __isset($name)
    {
        if ($name == 'author' && !empty($this->author_id)) {
            return true;
        } else {
            return false;
        }

    }
}
