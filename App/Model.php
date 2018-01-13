<?php
namespace App;

use App\Db;
use App\Exceptions\DbRequestException;

use App\Exceptions\ItemNotFoundException;
use App\Exceptions\MultiException;

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
    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM' . ' ' . static::$table;
        return $db->queryEach($sql, [], static::class);
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
        try {
        $db->execute($sql, $data);
        } catch (\Throwable $e) {
            throw new DbRequestException('Ошибка обновления записи');
        }
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
            if ('id' == $field) {
                continue;
            }
            $fieldNames[] = $field;

                $values[':'.$field] = $value;
        }

        $sql ='INSERT INTO '. static::$table .'
            ('. implode(', ', $fieldNames) . ')
            VALUES ('.implode(', ', array_keys($values)).')';

        $db->execute($sql, $values);
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

        if (empty($this->id)) {
            $this->insert();

        } else {
            $this->update();
        }
    }


    public function fill(array $data)
    {
        $errors = new MultiException();
        foreach ($data as $property => $value) {
            if ('id'== $property || !property_exists($this, $property)) :
                continue;
            endif;

            $exception ='App\Exceptions\Validate\\'. ucfirst($property).'Exception';

            if (empty($value)) :
                $errors->addError(new $exception);
            endif;
        }

        if ($errors->empty()) :
            foreach ($data as $key => $value) :
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            endforeach;
        else :
            throw $errors;
        endif;
    }
}
