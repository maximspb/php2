<?php
require __DIR__ . '/autoload.php';
use App\Models\Article;

$view = new \App\View();
$view->news = Article::getLastRec(3);
$view->display(__DIR__ . '/templates/indexTpl.php');
