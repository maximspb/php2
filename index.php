<?php
require __DIR__.'/autoload.php';
use Models\Article;

$pageTitle = 'Главная страница';
$news = Article::getAll('ORDER BY id DESC LIMIT 3');
include __DIR__ . '/templates/indexTpl.php';
