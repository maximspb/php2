<?php
namespace App;

use App\Db;
use App\Exceptions\DbRequestException;
use App\Exceptions\InsertRecordException;
use App\Exceptions\ItemNotFoundException;
use App\Exceptions\MultiException;
use App\Exceptions\EmptyTitleException;
use App\Exceptions\EmptyTextException;
use App\Models\Article;

/**
 * Class Model
 * @package App
 */
abstract class Model
{

    /**
     * @var array
     */
    protected static $table;
    protected static $data = [];

    /**
     * @property int $id
     */
    public $id;

    /**
     * получение массива всех записей из таблицы в виде объектов класса
     * @return array
     */

    public static function getAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM' . ' ' . static::$table;
        return $db->query($sql, [], static::class);
    }

    /**
     * поиск записи в таблице по id и возврат объекта
     * @param $id
     * @return object
     */
    public static function findById($id)
    {

        $db = new Db();
        $data =[':id'=>$id];
        $sql ='SELECT * FROM'.' '. static::$table.' '. 'WHERE id = :id';
        $arr = $db->query($sql, $data, static::class);
        if (!empty($arr)) {
            return $arr[0];
        } else {
            throw new ItemNotFoundException('Страница не найдена');
        }
    }


    /**
     * обновление записи в таблице
     * @return bool
     */

    protected function update()
    {
        $db = new Db();
        $fields = get_object_vars($this);
        $sets =[];
        $data =[];
        foreach ($fields as $name => $value) {
            $data[':'.$name] = $value;
            if ('id' == $name) {
                continue;
            }
            $sets[] = $name . ' = :'.$name;
        }
        $sql ='UPDATE '. static::$table .' '.
            'SET '. implode(', ', $sets) .
            ' WHERE id = :id';
        $db->execute($sql, $data);
    }

    /**
     * вставка новой записи в таблицу
     * @return bool
     */
    protected function insert()
    {

        $db = new Db();
        $fields = get_object_vars($this);
        $fieldNames=[];
        $values =[];
        foreach ($fields as $field => $value) {
                $fieldNames[] = $field;
                $values[':'.$field] = $value;
        }

        $sql ='INSERT INTO '. static::$table .'
            ('. implode(', ', $fieldNames) . ')
            VALUES ('.implode(', ', array_keys($values)).')';
        try {
        $db->execute($sql, $values);
        } catch (\Throwable $e) {
            throw new DbRequestException('Ошибка добавления записи');
        }
        $this->id = $db->lastId();
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $db = new Db();
        $data=[':id'=>$this->id];
        $sql ='DELETE FROM '.static::$table.' '.'WHERE id =:id';
        try {
            $db->execute($sql, $data);
        } catch (\Throwable $e) {
            throw new DbRequestException('Ошибка удаления из базы');
        }
    }

    /**
     *
     * @return bool
     */
    public function save()
    {

        if (!empty($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function fill(array $data)
    {
        $errors = new MultiException();
        if (array_key_exists('title', $data) && '' == $data['title']) {
            $errors->addError(new \App\Exceptions\EmptyTitleException('Пустое поле заголовка'));
        }
        if (array_key_exists('text', $data) && '' == $data['text']){

            $errors->addError(new EmptyTextException('Пустое поле текста'));
        }

        foreach ($data as $key=>$value):
            if (property_exists($this, $key)){
                $this->$key = $value;
            }
        endforeach;


        if (!$errors->empty()) :
            throw $errors;
        endif;
    }
}
