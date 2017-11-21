<?php
require __DIR__ . '/../autoload.php';
require __DIR__.'/../App/configs/urlParams.php';

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
