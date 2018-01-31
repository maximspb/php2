<?php

namespace App;

/**
 * класс-Синглтон.
 * Class Config
 * @package App
 */
class Config
{
    private static $instance;
    private $data;
    private $mailConfig;

    protected function __construct()
    {
        $this->data = include_once __DIR__ . '/configs/params.php';
        $this->mailConfig = include_once __DIR__ . '/configs/mailconfig.php';
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
    public function getMailConfig()
    {
        return $this->mailConfig;
    }
}