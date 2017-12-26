<?php
require __DIR__ . '/../autoload.php';
$url = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $url);
$controller = empty($urlParts[1]) ? 'Index' : $urlParts[1];
$actionType = empty($urlParts[2]) ? 'Default': $urlParts[2];

try {
    $class ='\\App\\Controllers\\'.$controller;
    $ctrl = new $class;
    $ctrl->action($actionType);

} catch (\App\Exceptions\ItemNotFoundException $error) {
    $error->pageNotFound();
    die;
} catch (\App\Exceptions\DbConnectException $error) {
    $error->errorPage();
    die;

} catch (\Throwable $e) {
    $e->getMessage();
}
