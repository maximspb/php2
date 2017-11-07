<?php
require __DIR__ . '/autoload.php';

use App\Models\Article;

$id = isset($_GET['id']) ? $_GET['id'] : false;
$view = new \App\View();
$view->article = Article::findById($id);

if ($id) {
    $view->display(__DIR__ . '/templates/articleTpl.php');
} else {
    header('Location: /index.php');
}
