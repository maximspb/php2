<?php

namespace App;

use App\View;

class AdminDataTable
{
    protected $models;
    protected $functions;

    public function __construct(array $models, array $functions)
    {
        $this->models = $models;
        $this->functions = $functions;
    }
    public function render($template)
    {
        $view = new View();
        $view->functions  = $this->functions;
        $view->models = $this->models;
        $view->display($template);
    }
}