<?php
namespace App\Controllers;

use App\View;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function access()
    {
        return true;
    }

    public function action(string $actionType)
    {
        $method = 'action'.$actionType;
        if ($this->access()) {
            $this->$method();
        } else {
            http_response_code(403);
            echo 'Доступ  закрыт';
            exit(1);
        }
    }
}
