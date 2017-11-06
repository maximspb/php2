<?php
namespace App\Traits;

/**
 * Trait MagicProperties
 * @package App\Traits
 */
trait MagicProperties
{
    /**
     * @var array $data
     */
    protected $data =[];
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    public function __get($name)
    {
        return $this->data[$name];
    }
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}