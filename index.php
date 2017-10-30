<?php
require __DIR__ . '/autoload.php';
use App\Models\Article;

$news = Article::getLastRec(3);
include __DIR__ . '/templates/indexTpl.php';
