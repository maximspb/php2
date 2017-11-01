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
    protected function update()
    {
        $fields = get_object_vars($this);
        $sets =[];
        $data =[];
        foreach ($fields as $name => $value) {
            $data[':'.$name] = $value;
            if ('id' == $name) {
                continue;
            }
            $sets[] = $name . '= :'.$name;

        }
        $sql ='UPDATE '. static::$table .' '.
            'SET '. implode(', ', $sets) .
            ' WHERE id = :id';

        $db = new Db();
        return $db->execute($sql, $data);
    }
    protected function insert()
    {
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
            $db = new Db();
        return $db->execute($sql, $values);
    }
    public function delete()
    {
        $data=[':id'=>$this->id];
        $sql ='DELETE FROM '.static::$table.' '.'WHERE id =:id';
        $db = new Db();
        return $db->execute($sql, $data);
    }
    public function save()
    {
        if (empty($this->id)) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }
}
