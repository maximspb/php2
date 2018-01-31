<?php
require __DIR__ . '/../autoload.php';
$url = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $url);
$controller = empty($urlParts[1]) ? 'Index' : $urlParts[1];
$actionType = empty($urlParts[2]) ? 'Default': $urlParts[2];


$class ='\\App\\Controllers\\'.$controller;
$ctrl = new $class;
try {
    $ctrl->action($actionType);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit(1);
} catch (\App\Exceptions\Exception404 $e){
    echo $e->getMessage();
    exit(1);
}
