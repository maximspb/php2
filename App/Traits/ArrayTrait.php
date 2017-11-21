<?php

namespace App\Traits;

/**
 * Trait ArrayTrait
 * @package App\Traits
 * Трейт методов для интерфейсов \Iterator, \ArrayAccess
 */
trait ArrayTrait
{

    protected $data =[];

    public function current()
    {
        return current($this->data);
    }


    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }


    public function valid()
    {
        return (false !== current($this->data));
    }


    public function rewind()
    {
        reset($this->data);
    }


    public function offsetExists($offset)
    {
        return array_key_exists($this->data, $offset);
    }


    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }


    public function offsetSet($offset, $value)
    {
        $this->data[!empty($offset)] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}