<?php
namespace App\Exceptions;

use App\Traits\MagicProperties;
use App\Traits\ArrayTrait;

class MultiException extends \Exception implements \Throwable, \ArrayAccess, \Iterator
{
    protected $data =[];
    use ArrayTrait;
    use MagicProperties;

    public function addError(\Throwable $error)
    {
        $this->data[] = $error;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function empty() : bool
    {
        return empty($this->data);
    }
    public function getAlldata()
    {
        return $this->data;
    }



}
