<?php
spl_autoload_register(
    function ($class) {
        $class = str_replace('\\', '/', $class);
        //echo $class; die;
        require __DIR__ . '/' . $class . '.php';
    }
);
