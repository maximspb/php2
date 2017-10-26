<?php
spl_autoload_register(
    function ($class) {
        $class = str_replace('\\', '/', $class);
        require __DIR__.'/App'.'/'. $class . '.php';
    }
);
