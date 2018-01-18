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

} catch (\App\Exceptions\Exception404 $error) {
    http_response_code(404);
    include __DIR__.'/../templates/404.php';
    exit(1);
} catch (\App\Exceptions\DbConnectException $error) {
    echo $error->getMessage();
    exit(1);

} catch (\Throwable $e) {
    echo $e->getMessage();
    exit(1);
}
