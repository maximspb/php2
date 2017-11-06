<?php
require __DIR__ . '/autoload.php';

use App\Models\Article;

$id = isset($_GET['id']) ? $_GET['id'] : false;
$view = new \App\View();
$view->article = Article::findById($id);


//массив всех id в таблице новостей для сверки с id из GET-запроса
$idList = array_column(Article::getAll(), 'id');

//При корректном id - вывод шаблона представления, при пустом или некорректном - переадресация на главную стр
if ($id && in_array($id, $idList)) {
    $view->display(__DIR__ . '/templates/articleTpl.php');
} else {
    header('Location: /index.php');
}
