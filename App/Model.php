<?php
namespace App;

use App\Traits\MagicProperties;

use App\Db;

/**
 * Class Model
 * @package App
 */
abstract class Model
{
    use MagicProperties;
    /**
     * @var array
     */
    protected static $table = [];
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
        $data =[':id'=>$id];
        $sql ='SELECT * FROM'.' '. static::$table.' '. 'WHERE id = :id';
        $db = new Db();
        $arr = $db->query($sql, $data, static::class);
        return $arr[0];
    }

    /**
     * обновление записи в таблице
     * @return bool
     */
    protected function update()
    {
        $fields = get_object_vars($this);
        $sets =[];
        $data =[];
        foreach ($fields as $name => $value) {
            if ('data' == $name) {
                continue;
            }
            $data[':'.$name] = $value;
            if ('id' == $name) {
                continue;
            }
            $sets[] = $name . ' = :'.$name;
        }
        $sql ='UPDATE '. static::$table .' '.
            'SET '. implode(', ', $sets) .
            ' WHERE id = :id';
        $db = new Db();
        return $db->execute($sql, $data);
    }

    /**
     * вставка новой записи в таблицу
     * @return bool
     */
    protected function insert()
    {
        $fields = get_object_vars($this);
        $fieldNames=[];
        $values =[];
        $db = new Db();
        foreach ($fields as $field => $value) {
            if ('data' == $field) {
                    continue;
            }
                $fieldNames[] = $field;
                $values[':'.$field] = $value;
        }
        $sql ='INSERT INTO '. static::$table .'
            ('. implode(', ', $fieldNames) . ')
            VALUES ('.implode(', ', array_keys($values)).')';
        $db->execute($sql, $values);
        return $this->id = $db->lastId();
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $data=[':id'=>$this->id];
        $sql ='DELETE FROM '.static::$table.' '.'WHERE id =:id';
        $db = new Db();
        return $db->execute($sql, $data);
    }

    /**
     *
     * @return bool
     */
    public function save()
    {
        if (empty($this->id)) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }
}
