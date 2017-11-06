<?php

namespace App;

/**
 * класс-Синглтон.
 * Class Config
 * @package App
 */
class Config
{
    protected static $instance;
    protected $data;

    protected function __construct()
    {
        include_once __DIR__.'/params.php';
        $this->data = $data;
    }
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getData()
    {
        return $this->data;
    }
}