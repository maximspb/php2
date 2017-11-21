<?php
namespace App\Exceptions;

use App\Traits\ArrayTrait;

class MultiException extends \Exception implements \Throwable, \ArrayAccess, \Iterator
{
    /**
     *трейт с методами итерации
     */
    use ArrayTrait;

    /**
     * @var array
     * массив всех ошибок, взятых в мультиисключение
     */
    protected $data =[];

    /**
     * @param \Throwable $error
     * сбор исключений в массив
     */
    public function addError(\Throwable $error)
    {
        $this->data[] = $error;
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
